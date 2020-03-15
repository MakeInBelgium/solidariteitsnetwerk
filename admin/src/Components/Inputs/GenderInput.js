import React from 'react';
import {RadioButtonGroupInput} from 'react-admin';
import {blue, pink} from '@material-ui/core/colors';
import {GenderFemale, GenderMale} from 'mdi-material-ui';

const genderRenderer = gender => {
  return gender.icon;
};

const GenderInput = ({options, ...props}) => <RadioButtonGroupInput
  options={{...options, row: true}}
  optionText={genderRenderer}
  translateChoice={false}
  choices={[
    {
      id: 'http://schema.org/Male',
      name: 'Male',
      icon: <GenderMale style={{color: blue[400]}}/>,
    },
    {
      id: 'http://schema.org/Female',
      name: 'Female',
      icon: <GenderFemale style={{color: pink[400]}}/>,
    },
  ]}  {...props} />;

export default GenderInput;
