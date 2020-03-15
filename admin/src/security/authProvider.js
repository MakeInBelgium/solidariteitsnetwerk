const authenticationTokenUri = `${process.env.REACT_APP_API_ENTRYPOINT}/authentication_token`;

const decodeJWTToken = (token) => {
  var base64Url = token.split('.')[1];
  var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  }).join(''));

  return JSON.parse(jsonPayload);
};

const isExpired = (token) => {
  const { exp } = decodeJWTToken(token);

  return !exp || new Date().getTime() > exp*1000;
};

/**
 * Storing credentials, for now using localStorage.
 * @param token
 * @param user
 * @param roles
 */
const storeCredentials = ({token, user, roles}) => {
  localStorage.setItem('token', token); // The JWT token is stored in the browser's local storage
  localStorage.setItem('user', JSON.stringify(user));
  localStorage.setItem('roles', JSON.stringify(roles));
};

/**
 * Remove stored credentials, essentially logging out.
 */
const removeCredentials = () => {
  localStorage.removeItem('token');
  localStorage.removeItem('user');
  localStorage.removeItem('roles');
};

const authProvider = {
  /**
   * Log in procedure.
   *
   * @param username
   * @param password
   * @returns {Promise<any>}
   */
  login: ({username, password}) => {
    const request = new Request(authenticationTokenUri, {
      method: 'POST',
      body: JSON.stringify({username, password}),
      headers: new Headers({'Content-Type': 'application/json'}),
    });
    // Send the authentication request.
    return fetch(request).then(response => {
      if (response.status < 200 || response.status >= 300) {
        // Fail on request errors.
        throw new Error(response.statusText);
      }
      // Parse JSON response
      const json = response.json();
      return json;
    }).then((credentials) => {
      // Proceed log in.
      storeCredentials(credentials);
    });
  },
  /**
   * Logging out.
   * @returns {Promise<void>}
   */
  logout: () => {
    removeCredentials();
    return Promise.resolve();
  },
  /**
   * Catching authentication errors on the API.
   * @param error
   * @returns {Promise<never>|Promise<void>}
   */
  checkError: (error) => {
    const status = error.status;
    if (status === 401 || status === 403) {
      // 401 Unauthorized or 403 Forbidden
      removeCredentials();
      return Promise.reject();
    }
    return Promise.resolve();
  },
  /**
   * Check if we still have a token.
   *
   * @returns {Promise<never>|Promise<void>}
   */
  checkAuth: () => {
    const token = localStorage.getItem('token');

    if(!token || isExpired(token)) {
      removeCredentials();
      return Promise.reject();
    }

    const userJson = localStorage.getItem('user');

    if(!userJson) {
      return Promise.reject();
    }

    return Promise.resolve();
  },
  /**
   * Return user's stored permissions.
   *
   * @todo: routinely refresh permissions?
   *
   * @param params
   * @returns {any}
   */
  getPermissions: (params) => {
    const userRoles = localStorage.getItem('roles');
    return userRoles ? Promise.resolve(JSON.parse(userRoles)) : Promise.reject();
  }
};

export default authProvider;
