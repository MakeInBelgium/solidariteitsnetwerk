import React from 'react';
import { FunctionField } from 'react-admin';
import PropTypes from 'prop-types';

const NameField = props => <FunctionField label="Name" render={record => `${record.first_name} ${record.last_name}`} {...props} />;

NameField.propTypes = {
    label: PropTypes.string,
    record: PropTypes.object,
    source: PropTypes.string.isRequired,
  };
  NameField.defaultProps = {
    addField: true,
    addLabel: true,
  };
  

export default NameField;
