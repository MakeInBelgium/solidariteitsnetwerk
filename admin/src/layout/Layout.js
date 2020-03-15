import React from 'react';
import { Layout } from 'react-admin';
import AppBar from './AppBar';
import Menu from './Menu';

const CustomLayout = props => (
  <Layout {...props} appBar={AppBar} menu={Menu} />
);

export default CustomLayout;
