import {
  Box,
  Dialog,
  DialogActions,
  DialogContent,
  DialogTitle,
} from '@material-ui/core';
import IconContentAdd from '@material-ui/icons/Add';
import IconCancel from '@material-ui/icons/Cancel';
import React, {useState} from 'react';
import {
  AutocompleteInput,
  Button,
  Create,
  ReferenceInput, SaveButton,
  SimpleForm,
  TextInput, useNotify,
  useTranslate,
} from 'react-admin';
import {InputGuesser} from '@api-platform/admin';
import RichTextInput from 'ra-input-rich-text';
import GenderInput from './GenderInput';
import PersonTypeInput from './PersonTypeInput';
import inflection from 'inflection';
import {red} from '@material-ui/core/colors';

const personDefaultValue = {
  gender: 'http://schema.org/Male',
  type: 'senior',
  address: {
    addressRegion: 'Antwerp',
    addressCountry: 'Belgium',
  }
};

const QuickCreateForm = ({resource, onSave, formFields, ...props}) => {
  const basePath = `/${resource}`;

  return (
    <Create
      resource={resource}
      basePath={basePath}
      {...props}
    >
      <SimpleForm
        initialValues={personDefaultValue}
        redirect={(basePath, id, data) => {
          console.log(basePath, id, data);
          onSave(id, data);
          return false;
        }}
        {...props}
      >
        {formFields}
      </SimpleForm>
    </Create>
  );
};

const QuickCreateButton = ({resource, formFields, ...props}) => {
  const translate = useTranslate();

  const [state, setState] = useState({
    error: false,
    showDialog: false,
  });

  const handleClick = () => setState(state => ({...state, showDialog: true}));
  const handleCloseClick = () => setState(
    state => ({...state, showDialog: false}));

  const handleSave = (id, data) => {
    setState(state => (
      {...state, showDialog: false}
    ));
  };

  return <>
    <Button size="small" onClick={handleClick} label="ra.action.create">
      <IconContentAdd/>
    </Button>
    <Dialog
      open={state.showDialog}
      fullWidth
      aria-label={translate('ra.action.create')}
    >
      <DialogTitle>
        {translate('ra.action.create')}
        {' '}
        {inflection.humanize(
          translate(`resources.${resource}.name`,
            {
              smart_count: 1,
              _: inflection.singularize(resource),
            }),
          true,
        )}
      </DialogTitle>
      <DialogContent>
        <QuickCreateForm
          resource={resource}
          formFields={formFields}
          onSave={handleSave}
          fullWidth
        />
      </DialogContent>
      <DialogActions>
        <Button
          label={"ra.action.cancel"}
          onClick={handleCloseClick}
        >
          <IconCancel />
        </Button>
      </DialogActions>
    </Dialog>
  </>;
};

const QuickAddInput = ({reference = '', optionText = 'name', children, ...props}) => {
  return <Box display="flex" alignItems="center">
    <Box flex={1}>
    <ReferenceInput reference={reference} {...props}>
      <AutocompleteInput optionText={optionText}/>
    </ReferenceInput>
    </Box>
    <Box>
      <QuickCreateButton formFields={children} resource={reference}/>
    </Box>
  </Box>;
};

export default QuickAddInput;
