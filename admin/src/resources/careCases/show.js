import React from 'react';
import { ShowGuesser, FieldGuesser} from '@api-platform/admin';

import {TextField, RichTextField, ReferenceField} from 'react-admin';
import CareCaseStatusField from '../../Components/Fields/CareCaseStatusField';

export const CareCaseShow = props => (
  <ShowGuesser {...props}>
    <FieldGuesser source={"caseName"} addLabel={true} />
    <ReferenceField reference="people" source="senior">
      <TextField source="name"/>
    </ReferenceField>

    <ReferenceField reference="people" source="volunteer">
      <TextField source="name"/>
    </ReferenceField>

    <RichTextField source={"description"} addLabel={true} />
    <CareCaseStatusField source={"status"} addLabel={true} />
    <FieldGuesser source={"createdAt"} addLabel={true} />
    <FieldGuesser source={"updatedAt"} addLabel={true} />
    <FieldGuesser source={"createdBy"} addLabel={true} />
    <FieldGuesser source={"updatedBy"} addLabel={true} />
  </ShowGuesser>
);
