import React from 'react';
import PropTypes from 'prop-types';
import { Icon } from '@material-ui/core';
import {Senior, Volunteer} from '../icons';

// volunteer or senior
const PersonTypeField = ({source, record = {}}) => {
  const type = record[source];
  const icon = type === 'volunteer' ? <Volunteer /> : <Senior />;


  return <Icon label={type}>{icon}</Icon>;
};

PersonTypeField.defaultProps = {
  addLabel: true,
  label: 'Type'
};

PersonTypeField.propTypes = {
  label: PropTypes.string,
  record: PropTypes.object,
  source: PropTypes.string
};

export default PersonTypeField;
