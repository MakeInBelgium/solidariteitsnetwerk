import React from 'react';
import PropTypes from 'prop-types';
import { GenderMale, GenderFemale } from 'mdi-material-ui';
import { Icon } from '@material-ui/core';
import { blue, pink } from '@material-ui/core/colors';

const GenderField = ({source, record = {}}) => {
  const gender = record[source] === 'http://schema.org/Male' ? 'm' : 'v';
  const color = gender === 'm' ? blue : pink;
  const icon = gender === 'm' ? <GenderMale style={{color: blue[400]}} /> : <GenderFemale  style={{color: pink[400]}}  />;


  return <Icon style={{color: color}} label={gender}>{icon}</Icon>;
};

GenderField.defaultProps = {
  addLabel: true,
  label: 'Geslacht'
};

GenderField.propTypes = {
  label: PropTypes.string,
  record: PropTypes.object,
  source: PropTypes.string
};

export default GenderField;
