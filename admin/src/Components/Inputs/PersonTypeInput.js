import { HandHeart, AccountQuestion } from 'mdi-material-ui';
import React from 'react';
import { RadioButtonGroupInput } from 'react-admin';
import {Senior, Volunteer} from '../icons';

const TypeRenderer = type => {
  return type.icon;
};

const PersonTypeInput = ({options, ...props}) => <RadioButtonGroupInput
  options={{...options, row: true}}
  optionText={TypeRenderer}
  translateChoice={false}
  choices={[
    {id: 'volunteer', name: 'Volunteer', icon: <Volunteer/>},
    {id: 'senior', name: 'Senior', icon: <Senior/>},
  ]}  {...props} />;

export default PersonTypeInput;
