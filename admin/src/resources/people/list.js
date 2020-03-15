import React from 'react';
import { FieldGuesser, ListGuesser} from '@api-platform/admin';

import {
  Datagrid, EditButton,
  Filter,
  List,
  SearchInput,
  TextField,
  TextInput,
} from 'react-admin';
import PersonTypeField from '../../Components/Fields/PersonTypeField';
import GenderField from '../../Components/Fields/GenderField';
import PersonTypeFilter from '../../Components/Filters/PersonTypeFilter';

const PersonFilter = (props) => (
  <Filter {...props}>
    <PersonTypeFilter source="type" label="" alwaysOn />
    <SearchInput source="multiSearch_q" alwaysOn />
    <TextInput source={"address.addressLocality"} label={'resources.postal_addresses.fields.addressLocality'} />
    <TextInput source={"address.addressRegion"} label={'resources.postal_addresses.fields.addressRegion'} />
  </Filter>
);

export const PersonList = props => (
  <List {...props} filters={<PersonFilter/>}>
    <Datagrid rowClick="edit">
      <FieldGuesser source={"givenName"} />
      <FieldGuesser source={"familyName"} />
      <FieldGuesser source={"email"} />
      <PersonTypeField source={"type"} />
      <TextField source={"address.addressLocality"} label={'resources.postal_addresses.fields.addressLocality'} />
      <TextField source={"address.addressRegion"} label={'resources.postal_addresses.fields.addressRegion'} />
      <GenderField source={"gender"} />
      <EditButton />
    </Datagrid>
  </List>
);
