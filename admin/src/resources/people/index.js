import {PersonCreate} from './create.js';
import {PersonEdit} from './edit.js';
import {PersonShow} from './show.js';
import {PersonList} from './list.js';
import {AccountQuestion} from 'mdi-material-ui';

export default {
  name: 'people',
  create: PersonCreate,
  edit: PersonEdit,
  show: PersonShow,
  list: PersonList,
  icon: AccountQuestion,
};
