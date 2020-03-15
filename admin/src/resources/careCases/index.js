import {CareCaseCreate} from './create.js';
import {CareCaseEdit} from './edit.js';
import {CareCaseShow} from './show.js';
import {CareCaseList} from './list.js';
import {AccountQuestion} from 'mdi-material-ui';

export default {
  name: 'care_cases',
  create: CareCaseCreate,
  edit: CareCaseEdit,
  show: CareCaseShow,
  list: CareCaseList,
  icon: AccountQuestion,
};
