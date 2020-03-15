import React, {useState} from 'react';
import {useSelector} from 'react-redux';
import {useMediaQuery} from '@material-ui/core';
import {
  useTranslate,
  MenuItemLink,
  DashboardMenuItem,
  usePermissions,
} from 'react-admin';
import {withRouter} from 'react-router-dom';
import PetsIcon from '@material-ui/icons/Pets';
import {
  HandHeart,
  AccountQuestion,
  CalendarHeart,
  Finance,
  TuneVertical,
  AccountTie,
  AccountMultiple,
  ImageAlbum,
} from 'mdi-material-ui';
import SubMenu from './SubMenu';

const Menu = ({onMenuClick, dense, logout}) => {
  const [state, setState] = useState({
    menuGeneral: true,
    menuPension: false,
    menuAdmin: false,
  });

  const translate = useTranslate();
  const isXSmall = useMediaQuery(theme => theme.breakpoints.down('xs'));
  const { permissions } = usePermissions();

  const open = useSelector(state => state.admin.ui.sidebarOpen);

  const handleToggle = menu => {
    setState(state => ({...state, [menu]: !state[menu]}));
  };

  return (
    <div>
      {' '}
      <DashboardMenuItem leftIcon={<Finance/>} onClick={onMenuClick}/>
      {/* General menu */}
      <SubMenu
        handleToggle={() => handleToggle('menuGeneral')}
        isOpen={state.menuGeneral}
        name="pos.menu.general"
        icon={<PetsIcon/>}
        sidebarIsOpen={open}
        dense={dense}
      >
        <MenuItemLink
          to={`/people?filter={"type":["volunteer"]}`}
          primaryText={translate(`pos.menu.volunteers`, {
            smart_count: 2,
          })}
          leftIcon={<HandHeart/>}
          onClick={onMenuClick}
        />
        <MenuItemLink
          to={`/people?filter={"type":["senior"]}`}
          primaryText={translate(`pos.menu.seniors`, {
            smart_count: 2,
          })}
          leftIcon={<AccountQuestion/>}
          onClick={onMenuClick}
        />
        <MenuItemLink
          to={`/care_cases`}
          primaryText={translate(`pos.menu.careCases`, {
            smart_count: 2,
          })}
          leftIcon={<CalendarHeart/>}
          onClick={onMenuClick}
        />
      </SubMenu>
      {/* Administratie menu */}
      <SubMenu
        handleToggle={() => handleToggle('menuAdmin')}
        isOpen={state.menuAdmin}
        name="pos.menu.admin"
        icon={<AccountTie/>}
        sidebarIsOpen={open}
        dense={dense}
      >
        {permissions && permissions.includes('ROLE_ADMIN') &&
        <MenuItemLink
          to={`/users`}
          primaryText={translate(`pos.menu.users`, {
            smart_count: 2,
          })}
          leftIcon={<AccountMultiple/>}
          onClick={onMenuClick}
          sidebarIsOpen={open}
          dense={dense}
        />
        }
      </SubMenu>
      {isXSmall && logout}
    </div>
  );
};

export default withRouter(Menu);
