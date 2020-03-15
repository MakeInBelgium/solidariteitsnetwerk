import polyglotI18nProvider from 'ra-i18n-polyglot';

import englishMessages from './en';
import dutchMessages from './nl';

const messages = {
  en: englishMessages,
  nl: dutchMessages,
};

export const i18nProvider = polyglotI18nProvider(locale => messages[locale], 'nl');
