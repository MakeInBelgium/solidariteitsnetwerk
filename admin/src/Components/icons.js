import { HandHeart, AccountQuestion } from 'mdi-material-ui';
import {Tooltip} from '@material-ui/core';
import React from 'react';

export const Volunteer = props => <Tooltip title="Volunteer"><HandHeart {...props} /></Tooltip>;
export const Senior = props => <Tooltip title="Senior"><AccountQuestion {...props} /></Tooltip>;
