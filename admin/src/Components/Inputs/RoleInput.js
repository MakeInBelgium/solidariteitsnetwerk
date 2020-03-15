import React from 'react';
import {SelectInput, usePermissions, useTranslate} from 'react-admin';

import {default as roles} from '../../security/roles';

const roleFormatter = (v = []) => {
  return v[0] || '';
};

const roleParser = role => ([role]);

const RoleInput = ({options, ...props}) => {
  const {permissions} = usePermissions();
  const translate = useTranslate();

  if(!permissions) {
    return null;
  }

  let choices = roles.filter(role => permissions.indexOf(role) !== -1);
  choices = choices.map(role => ({
    id: role,
    name: translate(`resources.users.values.roles.${role}`),
  }));

  return (<SelectInput
      format={roleFormatter}
      parse={roleParser}
      options={{...options, row: true}}
      choices={choices}
      {...props} />
  );
};

export default RoleInput;
