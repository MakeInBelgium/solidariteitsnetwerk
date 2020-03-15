import React from 'react';
import {Filter, SearchInput} from 'react-admin';
import {ListGuesser, FieldGuesser} from '@api-platform/admin';
import {ROLE_SUPERADMIN} from '../../security/roles';

const UserFilter = (props) => (
  <Filter {...props}>
    <SearchInput key="name" source="multiSearch_name" alwaysOn />
  </Filter>
);

const UserList = props => {
  const {permissions} = props;

  return (
  <ListGuesser {...props} filters={<UserFilter />}>
    <FieldGuesser source={"name"}/>
    <FieldGuesser source={"email"}/>
    <FieldGuesser source={"username"}/>
    {/*{(permissions && permissions.includes(ROLE_SUPERADMIN)) && <FieldGuesser source={"roles"}/>}*/}
    <FieldGuesser source={"updatedAt"}/>
  </ListGuesser>
  );
};

export default UserList;
