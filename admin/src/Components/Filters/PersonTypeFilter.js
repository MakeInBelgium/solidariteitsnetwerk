import { HandHeart, AccountQuestion } from 'mdi-material-ui';
import React from 'react';
import {CheckboxGroupInput} from 'react-admin';
import {Senior, Volunteer} from '../icons';

const TypeRenderer = ({record}) => {
  return record.icon;
};

const PersonTypeFilter = ({options, ...props}) => <CheckboxGroupInput
  options={{...options, row: true}}
  optionText={<TypeRenderer />}
  translateChoice={false}
  choices={[
    {id: 'volunteer', name: 'Volunteer', icon: <Volunteer/>},
    {id: 'senior', name: 'Senior', icon: <Senior/>},
  ]}  {...props} />;

export default PersonTypeFilter;
