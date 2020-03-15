import React from 'react';
import {CreateGuesser, EditGuesser, InputGuesser} from '@api-platform/admin';
import RichTextInput from 'ra-input-rich-text';
import {AutocompleteInput, ReferenceInput, TextInput} from 'react-admin';
import CareCaseStatusInput from '../../Components/Inputs/CareCaseStatusInput';

export const CareCaseEdit = props => (
  <EditGuesser {...props}>
    <InputGuesser source={"caseName"} />
    <ReferenceInput
      reference="people"
      source="senior"
      label="senior"
      filterToQuery={searchText => ({type: 'senior', multiSearch_q: searchText})}
      allowEmpty>
      <AutocompleteInput
        optionText="name"
        translateChoice={false}
      />
    </ReferenceInput>
    <ReferenceInput
      reference="people"
      source="volunteer"
      label="volunteer"
      filterToQuery={searchText => ({type: 'volunteer', multiSearch_q: searchText})}
      allowEmpty>
      <AutocompleteInput
        optionText="name"
        translateChoice={false}
      />
    </ReferenceInput>
    <RichTextInput source={"description"} />
    <CareCaseStatusInput source={"status"} />
  </EditGuesser>
);
