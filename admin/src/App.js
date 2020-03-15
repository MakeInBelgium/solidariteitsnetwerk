import {
  fetchHydra as baseFetchHydra,
  HydraAdmin
} from '@api-platform/admin';

import {parseHydraDocumentation} from '@api-platform/api-doc-parser';
import React from 'react';
import {Login} from 'react-admin';
import {Redirect, Route} from 'react-router-dom';
import {Dashboard} from './dashboard';
import {default as baseDataProvider} from './resources/dataProvider';
import {i18nProvider} from './i18n/I18nProvider';
import {Layout} from './layout';
import people from './resources/people';
import care_cases from './resources/careCases';
import media_objects from './resources/mediaObjects';
import users from './resources/users';
import authProvider from './security/authProvider';
import ResourceGuesser from '@api-platform/admin/lib/ResourceGuesser';
const entrypoint = process.env.REACT_APP_API_ENTRYPOINT;

function getAuthToken() {
  return localStorage.getItem('token');
}

export function headersWithToken() {
  return {Authorization: `Bearer ${getAuthToken()}`};
}

export const authenticatedFetch = (endpoint, options = {}) => fetch(`${entrypoint}/${endpoint}`, {
  ...options,
  headers: new Headers(headersWithToken())
});

const fetchHydra = (url, options = {}) =>
  baseFetchHydra(url, {
    ...options,
    headers: new Headers(headersWithToken()),
  });

const apiDocParser = entrypoint =>
  parseHydraDocumentation(entrypoint, {
    headers: new Headers(headersWithToken()),
  }).then(
    ({api}) => ({api}),
    result => {
      switch (result.status) {
        case 401:
          return Promise.resolve({
            api: result.api,
            customRoutes: [
              <Route
                path="/"
                render={() => {
                  return localStorage.getItem('token') ? (
                    window.location.reload()
                  ) : (
                    <Redirect to="/login"/>
                  );
                }}
              />,
            ],
          });

        default:
          return Promise.reject(result);
      }
    },
  );

const dataProvider = baseDataProvider(entrypoint, fetchHydra, apiDocParser);

const LoginPageWithBackground = () => (
  <Login backgroundImage="/blurred_bg.png"/>
);

export default () => (
  <HydraAdmin
    i18nProvider={i18nProvider}
    dashboard={Dashboard}
    authProvider={authProvider}
    layout={Layout}
    apiDocumentationParser={apiDocParser}
    dataProvider={dataProvider}
    entrypoint={entrypoint}
    loginPage={LoginPageWithBackground}
  >
    <ResourceGuesser name={'care_cases'} {...care_cases} />
    <ResourceGuesser name={'postal_addresses'}/>
    <ResourceGuesser name={'users'} {...users} />
    <ResourceGuesser name={'media_objects'} {...media_objects} />
    <ResourceGuesser name={'people'} {...people} />
  </HydraAdmin>
);
