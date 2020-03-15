import React, {useCallback, useEffect, useState} from 'react';
import {
  Button,
  Link,
  LoadingIndicator,
  useTranslate,
  useVersion,
} from 'react-admin';
import {Senior, Volunteer} from '../Components/icons';
import {
  Box,
  Card,
  CardContent,
  Typography,
  useMediaQuery,
} from '@material-ui/core';
import {authenticatedFetch} from '../App';

const styles = {
  root: {marginTop: '1em'},
  flex: {display: 'flex'},
  flexColumn: {display: 'flex', flexDirection: 'column'},
  leftCol: {flex: 1, marginRight: '1em'},
  rightCol: {flex: 1, marginLeft: '1em'},
  singleCol: {marginTop: '2em', marginBottom: '2em'},
};

const PersonStats = ({stats = []}) => {
  const translate = useTranslate();

  if (!stats) {
    return <LoadingIndicator/>;
  }

  const [seniorStats, volunteerStats] = stats;
  return (
    <Card>
      <CardContent>
        <Typography gutterBottom variant="h5" component="h2">{translate(
          'dashboard.personStats.title')}</Typography>
        <Box display="flex">
          <Box flex={1}>
            <Typography variant="caption"
                        component="strong"><Volunteer/> {translate(
              'dashboard.personStats.volunteers')}</Typography>
            <Typography>{volunteerStats.total}</Typography>

            <Box mt='1em'>
              <Link
                color={'primary'}
                to={`/people?filter={"type":["volunteer"]}`}
              >
                <Button variant="outlined" color="primary" label={'All volunteers'} />
              </Link>
            </Box>
          </Box>
          <Box flex={1}>
            <Typography variant="caption"
                        component="strong"><Senior/> {translate(
              'dashboard.personStats.seniors')}</Typography>
            <Typography>{seniorStats.total}</Typography>

            <Box mt='1em'>
              <Link
                to={`/people?filter={"type":["senior"]}`}
              >
                <Button variant="outlined" color="primary" label={'All seniors'} />
              </Link>
            </Box>
          </Box>
        </Box>
      </CardContent>
    </Card>
  );
};

const CareCasesStats = ({stats = []}) => {
  const translate = useTranslate();

  return (
    <Card>
      <CardContent>
        <Typography gutterBottom variant="h5" component="h2">{translate(
          'dashboard.careCasesStats.title')}</Typography>
        <Box display="flex" style={{flexWrap: 'wrap'}}>
          {!stats && <LoadingIndicator/>}
          {stats && stats.map(({status, total}) => <Box mb="1em" flex={'50%'}>
              <Typography variant="caption" component="strong">
                {translate(`resources.care_cases.statuses.${status}`)}
              </Typography>
              <Typography>{total}</Typography>
            </Box>,
          )}
        </Box>

        <Box mt='1em'>
          <Link
            to={`/care_cases`}
          >
            <Button variant="outlined" color="primary" label={'All cases'} />
          </Link>
        </Box>
      </CardContent>
    </Card>
  );
};

const Dashboard = props => {
  const [state, setState] = useState({
    personStats: null,
    careCaseStats: null,
  });
  const version = useVersion();
  const isXSmall = useMediaQuery(theme => theme.breakpoints.down('xs'));
  const isSmall = useMediaQuery(theme => theme.breakpoints.down('sm'));

  const fetchStats = useCallback(async () => {
    try {
      const response = await authenticatedFetch('users/dashboard');
      console.log(response);

      const json = await response.json();
      console.log(json);

      setState(state => ({
        ...state,
        personStats: json['people_status'],
        careCaseStats: json['care_cases_by_status'],
      }));
    } catch (error) {
      console.error('failed to fetch stats');
      console.error(error);

      setState(state => ({
        ...state,
        personStats: {},
        careCaseStats: {},
      }));
    }
  }, []);

  useEffect(() => {
    fetchStats();
  }, [version]);

  const {personStats, careCaseStats} = state;

  return isXSmall ? (
    <div style={styles.root}>
      <div style={styles.flexColumn}>
        <div style={styles.singleCol}>
          <PersonStats stats={personStats}/>
          <CareCasesStats stats={careCaseStats}/>
        </div>
      </div>
    </div>
  ) : isSmall ? (
    <div style={styles.root}>
      <div style={styles.flexColumn}>
        <div style={styles.singleCol}>
          <PersonStats stats={personStats}/>
          <CareCasesStats stats={careCaseStats}/>
        </div>
      </div>
    </div>
  ) : (
    <div style={styles.root}>
      <div style={styles.flex}>
        <div style={styles.leftCol}>
          <PersonStats stats={personStats}/>
        </div>
        <div style={styles.rightCol}>
          <CareCasesStats stats={careCaseStats}/>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
