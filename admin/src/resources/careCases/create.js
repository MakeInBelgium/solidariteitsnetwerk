import React from 'react';
import {InputGuesser} from '@api-platform/admin';
import RichTextInput from 'ra-input-rich-text';
import {
  AutocompleteInput,
  Create,
  ReferenceInput,
  SimpleForm, TextInput,
} from 'react-admin';
import CareCaseStatusInput from '../../Components/Inputs/CareCaseStatusInput';
import {Box} from '@material-ui/core';
import QuickAddInput from '../../Components/Inputs/QuickAddInput';
import GenderInput from '../../Components/Inputs/GenderInput';
import PersonTypeInput from '../../Components/Inputs/PersonTypeInput';

const careCaseDefaultValue = {
  status: 'new',
};

const QuickCreatePerson = (props) => (
  <>
    <Box>
      <Box>
        <Box display={{xs: 'block', sm: 'flex'}}>
          <Box flex={1} mr={{xs: 0, sm: '0.5em'}}>
            <InputGuesser
              source={'givenName'}
              autoFocus={true}
              {...props}
            />
          </Box>
          <Box flex={1} ml={{xs: 0, sm: '0.5em'}}>
            <InputGuesser
              source={'familyName'}
              {...props}
            />
          </Box>
        </Box>
        <TextInput
          source={'email'}
          {...props}
        />
        <TextInput
          source={'phoneNumber'}
          {...props}
        />
        <Box display={{xs: 'block', sm: 'flex'}}>
          <Box flex={1} mr={{xs: 0, sm: '0.5em'}}>
            <GenderInput
              source={'gender'}
              {...props}
            />
          </Box>
          <Box flex={1} ml={{xs: 0, sm: '0.5em'}}>
            <PersonTypeInput
              required
              source={'type'}
              {...props}
            />
          </Box>
        </Box>
      </Box>
      <Box>
        <Box display={{xs: 'block', sm: 'flex'}}>
          <Box flex={1} mr={{xs: 0, sm: '0.5em'}}>
            <TextInput
              required
              {...props}
              label={'resources.postal_addresses.fields.addressRegion'}
              source={'address.addressRegion'}
            />
          </Box>
          <Box flex={1} ml={{xs: 0, sm: '0.5em'}}>
            <TextInput
              {...props}
              label={'resources.postal_addresses.fields.addressCountry'}
              source={'address.addressCountry'}
            />
          </Box>
        </Box>
        <RichTextInput
          {...props}
          source={'description'}
        />
      </Box>
    </Box>
  </>
);

const CreateFields = (props) => (
  <>
    <Box p="1em">
      <Box display="flex" style={{width: '100%'}}>
        <Box flex={1} mr="1em">
          <InputGuesser
            source={'caseName'}
            {...props}
          />
          <QuickAddInput
            {...props}
            reference="people"
            optionText="name"
            source="senior"
            filterToQuery={searchText => ({
              type: 'senior',
              multiSearch_q: searchText,
            })}
            allowEmpty
          >
            <QuickCreatePerson fullWidth />
          </QuickAddInput>
          <CareCaseStatusInput
            source={'status'}
            {...props}
          />
        </Box>
        <Box flex={2}>
          <RichTextInput
            source="description"
            {...props}
          />
        </Box>
      </Box>
    </Box>
  </>
);

export const CareCaseCreate = props => (
  <Create {...props}>
    <SimpleForm initialValues={careCaseDefaultValue}>
      <CreateFields fullWidth />
    </SimpleForm>
  </Create>
);
