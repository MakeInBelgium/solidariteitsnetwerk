import React from 'react';
import PropTypes from 'prop-types';
import {careCaseStatusById} from '../Inputs/CareCaseStatusInput';
import {useTranslate} from 'ra-core';

const CareCaseStatusField = ({source, record = {}}) => {
  const translate = useTranslate();
  const statusId = record[source];

  const status = careCaseStatusById(statusId);

  return <span>{translate(`resources.care_cases.statuses.${status.name}`)}</span>;
};

CareCaseStatusField.defaultProps = {
  addLabel: true,
  label: 'Status'
};

CareCaseStatusField.propTypes = {
  label: PropTypes.string,
  record: PropTypes.object,
  source: PropTypes.string
};

export default CareCaseStatusField;
