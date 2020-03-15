import React from 'react';
import { AppBar, MenuItemLink } from 'react-admin';
import Typography from '@material-ui/core/Typography';
import { Avatar } from '@material-ui/core';
import UserMenu from './UserMenu';
import SettingsIcon from '@material-ui/icons/Settings';
import { makeStyles } from '@material-ui/core/styles';
import gravatar from 'gravatar';
import { forwardRef } from 'react';

const useStyles = makeStyles({
  title: {
    flex: 1,
    textOverflow: 'ellipsis',
    whiteSpace: 'nowrap',
    overflow: 'hidden',
  },
  spacer: {
    flex: 1,
  },
});

const UserAvatar = ({ email }) => <Avatar style={{ width: '32px', height: '32px', marginRight: '10px' }} src={gravatar.url(email, { s: '32' })} />;

const ConfigurationMenu = forwardRef(({ onClick }, ref) => (
  <MenuItemLink
    ref={ref}
    to="/configuration"
    primaryText="Configuration"
    leftIcon={<SettingsIcon />}
    onClick={onClick} // close the menu on click
  />
));

const TheUserMenu = props => {
  const user = JSON.parse(localStorage.getItem('user'));

  if(!user) {
    return null;
  }

  return (
    <UserMenu
      label={`${user.firstName} ${user.lastName}`}
      icon={UserAvatar(user)}
      {...props}
    />
  )
};

const MyAppBar = props => {
  const classes = useStyles();

  return (
    <AppBar {...props} userMenu={<TheUserMenu />}>
      <Typography
        color="inherit"
        className={classes.title}
        id="react-admin-title"
      />
      <span className={classes.spacer} />
    </AppBar>
  );
}

export default MyAppBar;
