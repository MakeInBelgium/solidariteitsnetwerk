import React from 'react';
import {SelectInput, useTranslate} from 'react-admin';

const careCaseStatuses = [
  {id: 'new', name: 'new'},
  {id: 'assigned', name: 'assigned'},
  {id: 'accepted', name: 'accepted'},
  {id: 'rejected', name: 'rejected'},
  {id: 'ongoing', name: 'ongoing'},
  {id: 'done', name: 'done'},
];

export const careCaseStatusById = (statusId) => careCaseStatuses.find(
  ({id}) => id === statusId);

const CareCaseStatusInput = ({...props}) => {
  const translate = useTranslate();

  return (<SelectInput
    choices={careCaseStatuses}
    optionText={({name}) => translate(`resources.care_cases.statuses.${name}`)}
    {...props}
  />);
};

export default CareCaseStatusInput;
