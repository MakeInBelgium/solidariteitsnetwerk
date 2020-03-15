import React from 'react';
import {ListGuesser, FieldGuesser} from '@api-platform/admin';
import {makeStyles} from '@material-ui/styles';
import {ImageField} from 'react-admin';

const thumbStyles = makeStyles({
  image: {
    maxWidth: '100px',
    height: 'auto',
  }
});

const DimensionField = ({record, source}) => {
  const [width, height] = record[source] || [];

  return (
    <span>{`${width}*${height}px`}</span>
  )
};

const bytesToSize = (bytes, decimals = 2) => {
  if (bytes === 0) return '0 Bytes';

  const k = 1024;
  const dm = decimals < 0 ? 0 : decimals;
  const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];

  const i = Math.floor(Math.log(bytes) / Math.log(k));

  return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
};

const FileSizeField = ({record, source}) => {
  const size = record[source];

  return (
    <span>{bytesToSize(size)}</span>
  )
};

export const MediaObjectList = props => (
  <ListGuesser {...props}>
    <ImageField classes={thumbStyles()} label={''} source={"thumbnails.square"}/>
    <FieldGuesser source={"relativePath"} />
    <FieldGuesser source={"mimeType"} />
    <FileSizeField source={"size"} />
    <DimensionField source={"dimensions"} />
  </ListGuesser>
);
