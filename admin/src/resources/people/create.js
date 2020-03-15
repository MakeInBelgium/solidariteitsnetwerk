import React from 'react';
import GenderInput from '../../Components/Inputs/GenderInput';
import PersonTypeInput from '../../Components/Inputs/PersonTypeInput';
import RichTextInput from 'ra-input-rich-text';
import {
  Create,
  SimpleForm,
  TextInput,
} from 'react-admin';
import {Box} from '@material-ui/core';
import InputGuesser from '@api-platform/admin/lib/InputGuesser';

const personDefaultValue = {
  gender: 'http://schema.org/Male',
  type: 'volunteer',
  address: {
    addressRegion: 'Antwerp',
    addressCountry: 'Belgium',
  }
};

const CreateFields = (props) => (
  <>
    <Box p="1em">
      <Box display="flex" style={{width: '100%'}}>
        <Box flex={1} mr="1em">
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

        <Box flex={2} ml="1em">
          <TextInput
            {...props}
            source={'address.streetAddress'}
            label={'resources.postal_addresses.fields.streetAddress'}
          />

          <Box display={{xs: 'block', sm: 'flex'}}>
            <Box flex={1} mr={{xs: 0, sm: '0.5em'}}>
              <TextInput
                {...props}
                source={'address.postalCode'}
                label={'resources.postal_addresses.fields.postalCode'}
              />
            </Box>
            <Box flex={1} ml={{xs: 0, sm: '0.5em'}}>
              <TextInput
                {...props}
                source={'address.addressLocality'}
                label={'resources.postal_addresses.fields.addressLocality'}
              />
            </Box>
          </Box>
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
    </Box>
  </>
);

export const PersonCreate = props => (
  <Create
    {...props}
  >
    <SimpleForm initialValues={personDefaultValue}>
      <CreateFields fullWidth />
    </SimpleForm>
  </Create>
);
