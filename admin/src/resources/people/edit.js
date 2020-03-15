import React from 'react';
import {InputGuesser} from '@api-platform/admin';
import GenderInput from '../../Components/Inputs/GenderInput';
import PersonTypeInput from '../../Components/Inputs/PersonTypeInput';
import RichTextInput from 'ra-input-rich-text';
import {Edit, FormTab, FormWithRedirect, TextInput} from 'react-admin';
import {Box} from '@material-ui/core';
import {TabbedFormView} from 'ra-ui-materialui/lib/form/TabbedForm';

/*const PersonEditForm = props => (
  <FormWithRedirect
    {...props}
    render={formProps => (<form>
      <Box p="1em">
        <Box display="flex">
          <Box flex={1} mr="1em">
            <InputGuesser resource="people" source={'givenName'} fullWidth/>
            <InputGuesser resource="people" source={'familyName'} fullWidth/>
            <InputGuesser resource="people" source={'email'} fullWidth/>
            <Box display="flex">
              <GenderInput resource="people" source={'gender'} fullWidth/>
              <PersonTypeInput required resource="people" source={'type'} fullWidth/>
            </Box>
          </Box>

          <Box flex={2} ml="1em">
            <TextInput resource="people"
                       label={'resources.postal_addresses.fields.streetAddress'}
                       source={'address.streetAddress'} fullWidth/>

            <Box display="flex">
              <Box flex={1}>
                <TextInput resource="people"
                           label={'resources.postal_addresses.fields.postalCode'}
                           source={'address.postalCode'} fullWidth/>
              </Box>
              <Box flex={1} ml="0.5em">
                <TextInput resource="people"
                           label={'resources.postal_addresses.fields.addressLocality'}
                           source={'address.addressLocality'} fullWidth/>
              </Box>
            </Box>
            <Box display="flex">
              <Box flex={1}>
                <TextInput resource="people"
                           required
                           label={'resources.postal_addresses.fields.addressRegion'}
                           source={'address.addressRegion'} fullWidth/>
              </Box>
              <Box flex={1} ml="0.5em">
                <TextInput resource="people"
                           label={'resources.postal_addresses.fields.addressCountry'}
                           source={'address.addressCountry'} fullWidth/>
              </Box>
            </Box>
            <RichTextInput resource="people" source={'description'} fullWidth/>
          </Box>
        </Box>
      </Box>
      <Toolbar>
        <Box display="flex" justifyContent="space-between" width="100%">
          <SaveButton
            record={formProps.record}
            saving={formProps.saving}
            handleSubmitWithRedirect={formProps.handleSubmitWithRedirect}
          />
          <DeleteButton resource="people" record={formProps.record}/>
        </Box>
      </Toolbar>
    </form>)
    }
  />
);*/

const GeneralTab = (props) => (
  <>
    <Box p="1em" fullWidth>
      <Box display="flex" style={{width: '100%'}}>
        <Box flex={1} mr="1em">
          <Box display={{xs: 'block', sm: 'flex'}}>
            <Box flex={1} mr={{xs: 0, sm: '0.5em'}}>
              <InputGuesser
                source={'givenName'}
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

const PersonEditForm = props => (
  <FormWithRedirect
    {...props}
    render={formProps => (<TabbedFormView {...formProps}>
      <FormTab label="general">
        <GeneralTab fullWidth />
      </FormTab>
      <FormTab label="cases" />
      <FormTab label="history" />
    </TabbedFormView>)
    }
  />
);

export const PersonEdit = props => <Edit
  {...props}
  undoable={false}
>
  <PersonEditForm/>
</Edit>;

