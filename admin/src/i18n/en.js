import englishMessages from 'ra-language-english';

const timestampableFields = {
  createdAt: 'Created at',
  updatedAt: 'Updated at',
};

const blamableFields = {
  createdBy: 'Created at',
  updatedBy: 'Created at',
};

const defaultFields = {
  ...timestampableFields,
  ...blamableFields,
};

export default {
  ...englishMessages,
  pos: {
    search: 'Search',
    configuration: 'Configuration',
    language: 'Language',
    menu: {
      // Admin
      admin: 'Administration',
      configuration: 'Configuration',
      users: 'Users',
      people: 'People',
      volunteers: 'Volunteers',
      careCases: 'Cases',
      seniors: 'Seniors',
      media: 'Media',
      general: 'General',
      // Misc
      profile: 'My profile',
    },
  },
  dashboard: {
    personStats: {
      title: 'People by type',
      volunteers: 'Volunteers',
      seniors: 'Seniors',
    },
    careCasesStats: {
      title: 'Care cases by status',
    }
  },
  resources: {
    people: {
      name: 'Person |||| People',
      fields: {
        givenName: 'Given name',
        familyName: 'Family name',
        email: 'Email address',
        address: 'Address',
        gender: 'Gender',
        description: 'Description',
      },
      tabs: {
      },
      page: {
      },
    },
    users: {
      name: 'User |||| Users',
      fields: {
        username: 'Username',
        email: 'Email Address',
        roles: 'User role',
        password: 'Password',
        firstName: 'First name',
        lastName: 'Last name',
        name: 'Name',
      },
      values: {
        roles: {
          ROLE_USER: 'User',
          ROLE_STAFF: 'Staff',
          ROLE_ADMIN: 'Administrator',
          ROLE_SUPERADMIN: 'Superadmin',
        },
      },
      tabs: {
      },
      page: {
      },
    },
    postal_addresses: {
      name: 'Address |||| Addresses',
      fields: {
        streetAddress: 'Street',
        postalCode: 'Postal code',
        addressLocality: 'Locality',
        addressRegion: 'Region',
        addressCountry: 'Country',
        ...defaultFields,
      },
      tabs: {
      },
      page: {
      },
    },
    media_objects: {
      name: 'Image |||| Images',
      fields: {
        contentUrl: 'Image path',
        mimeType: 'File type',
        size: 'File size',
        dimensions: 'Dimensions',
        relativePath: 'Relative path',
        thumbnails: 'Image formats',
        ...defaultFields,
      },
      tabs: {
      },
      page: {
      },
    },
    care_cases: {
      name: 'Case |||| Cases',
      fields: {
        ...defaultFields,
      },
      statuses: {
        new: 'New',
        assigned: 'Assigned',
        accepted: 'Accepted',
        rejected: 'Rejected',
        ongoing: 'Ongoing',
        done: 'Done',
      },
      tabs: {
      },
      page: {
      },
    },
  },
};
