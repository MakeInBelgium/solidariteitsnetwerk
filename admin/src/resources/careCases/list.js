import React from 'react';
import {FieldGuesser, ListGuesser} from '@api-platform/admin';
import {
  Datagrid, EditButton,
  Filter,
  List,
  ReferenceField,
  SearchInput,
  TextField,
} from 'react-admin';
import CareCaseStatusField from '../../Components/Fields/CareCaseStatusField';
import CareCaseStatusInput from '../../Components/Inputs/CareCaseStatusInput';

const CareCaseFilter = (props) => (
  <Filter {...props}>
    <CareCaseStatusInput source="status" />
    <SearchInput source="multiSearch_q" alwaysOn />
  </Filter>
);

export const CareCaseList = props => (
  <List
    filters={<CareCaseFilter/>}
    filterDefaultValues={{status: 'new'}}
    sort={{field: 'updatedAt', order: 'DESC'}}
    {...props}
  >
    <Datagrid rowClick="edit">
      <FieldGuesser source={"caseName"} />
      <ReferenceField reference="people" source="senior">
        <TextField source="name"/>
      </ReferenceField>

      <ReferenceField reference="people" source="volunteer">
        <TextField source="name"/>
      </ReferenceField>
      <CareCaseStatusField source={"status"} />
      <FieldGuesser source={"createdAt"} />
      <FieldGuesser source={"updatedAt"} />
      <EditButton />
    </Datagrid>
  </List>
);
