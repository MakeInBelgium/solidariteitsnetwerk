import React from 'react';
import { ShowGuesser, FieldGuesser} from '@api-platform/admin';

import {TextField, RichTextField} from 'react-admin';
import PersonTypeField from '../../Components/Fields/PersonTypeField';
import GenderField from '../../Components/Fields/GenderField';

export const PersonShow = props => (
  <ShowGuesser {...props}>
    <FieldGuesser source={"givenName"} addLabel={true} />
    <FieldGuesser source={"familyName"} addLabel={true} />
    <FieldGuesser source={"email"} addLabel={true} />
    <PersonTypeField source={"type"} addLabel={true} />
    {/*<FieldGuesser source={"address"} addLabel={true} />*/}
    <TextField label={'resources.postal_addresses.fields.streetAddress'} source={"address.streetAddress"} addLabel={true} />
    <TextField label={'resources.postal_addresses.fields.postalCode'} source={"address.postalCode"} addLabel={true} />
    <TextField label={'resources.postal_addresses.fields.addressLocality'} source={"address.addressLocality"} addLabel={true} />
    <TextField label={'resources.postal_addresses.fields.addressRegion'} source={"address.addressRegion"} addLabel={true} />
    <TextField label={'resources.postal_addresses.fields.addressCountry'} source={"address.addressCountry"} addLabel={true} />
    <GenderField source={"gender"} addLabel={true} />
    <RichTextField source={"description"} addLabel={true} />
  </ShowGuesser>
);
