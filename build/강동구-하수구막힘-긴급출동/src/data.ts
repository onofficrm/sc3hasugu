export type LocalArea = {
  slug: string;
  name: string;
  label: string;
  url?: string;
  clog_url?: string;
  clean_url?: string;
  focus?: 'clean' | 'clog' | string;
  meta_title?: string;
  meta_description?: string;
  guide_title?: string;
  guide_body?: string;
  issues?: string[];
  spots?: string[];
  faq?: Array<{
    question: string;
    answer: string;
  }>;
  clog_meta_title?: string;
  clog_meta_description?: string;
  clog_guide_title?: string;
  clog_guide_body?: string;
  clog_issues?: string[];
  clog_faq?: Array<{
    question: string;
    answer: string;
  }>;
};

export type SiteFaq = {
  question: string;
  answer: string;
};

type SiteRuntimeConfig = {
  regionName?: string;
  regionShort?: string;
  regionInitial?: string;
  siteName?: string;
  siteDescription?: string;
  companyName?: string;
  ceoName?: string;
  businessNumber?: string;
  phone?: string;
  email?: string;
  address?: string;
  seoTitle?: string;
  seoDescription?: string;
  mainKeyword?: string;
  secondaryKeywords?: string[];
  localAreas?: LocalArea[];
  activeAreaDetails?: LocalArea;
  areaSpots?: string[];
  faqs?: SiteFaq[];
  builderProjectId?: string;
  assetBase?: string;
  activeArea?: string;
  canonical?: string;
  pageFocus?: 'clean' | 'clog' | string;
};

declare global {
  interface Window {
    __SITE_CONFIG__?: SiteRuntimeConfig;
    __PINKRIBBON_DONG__?: string;
  }
}

const runtime = typeof window !== 'undefined' ? (window.__SITE_CONFIG__ || {}) : {};

export const regionName = runtime.regionName?.trim() || '지역';
export const regionShort = runtime.regionShort?.trim() || regionName.replace(/구$/, '');
export const regionInitial = runtime.regionInitial?.trim() || regionShort.charAt(0) || '긴';

const phone = runtime.phone?.trim() || '';

export const contactInfo = {
  phone,
  phoneFormatted: phone,
  phoneDisplay: phone,
  companyName: runtime.companyName?.trim() || '원진하수구',
  businessNumber: runtime.businessNumber?.trim() || '',
  address: runtime.address?.trim() || '',
  ceo: runtime.ceoName?.trim() || '',
};

export const keywords = {
  main: runtime.mainKeyword?.trim() || `${regionName}하수구청소`,
  secondary: Array.isArray(runtime.secondaryKeywords) ? runtime.secondaryKeywords : [],
};

export const localAreas = Array.isArray(runtime.localAreas) ? runtime.localAreas : [];

export const areaSpots = Array.isArray(runtime.areaSpots) ? runtime.areaSpots : [];
export const siteFaqs = Array.isArray(runtime.faqs) ? runtime.faqs : [];

export const activeLocalArea =
  runtime.activeAreaDetails ||
  localAreas.find((area) => area.name === runtime.activeArea) ||
  null;

export function assetUrl(filename: string) {
  const projectId = runtime.builderProjectId || 'gangdong-drain';
  const fallbackBase = `/plugin/onoff-builder-bridge/imports/${projectId}`;
  const base = (runtime.assetBase || fallbackBase).replace(/\/$/, '');
  return `${base}/images/${filename.replace(/^\/+/, '')}`;
}

export const pageFocus = (runtime.pageFocus || activeLocalArea?.focus || 'clean').trim();
export const isClogFocus = pageFocus === 'clog';

export function localAreaUrl(area: LocalArea) {
  return area.url || `/page/local-${area.slug}.php`;
}

export function localClogUrl(area: LocalArea) {
  return area.clog_url || `/page/clog-${area.slug}.php`;
}

export function relatedCleanUrl(area: LocalArea = activeLocalArea || { slug: '', name: '', label: '' }) {
  return area.clean_url || area.url || (area.slug ? `/page/local-${area.slug}.php` : '/#areas');
}

export function relatedClogUrl(area: LocalArea = activeLocalArea || { slug: '', name: '', label: '' }) {
  return area.clog_url || (area.slug ? `/page/clog-${area.slug}.php` : '/#areas');
}

export function phoneCtaLabel(area = regionName) {
  if (!contactInfo.phone) return `${area} 전화상담`;
  return contactInfo.phoneFormatted;
}

export function phoneCtaSubLabel(area = regionName) {
  return `${area} 지금 전화상담`;
}

export function telHref() {
  return `tel:${contactInfo.phone.replace(/[^0-9+]/g, '')}`;
}

export function getDongFromUrl() {
  if (typeof window === 'undefined') return '';
  const activeArea = (window.__SITE_CONFIG__?.activeArea || '').trim();
  if (activeArea) return activeArea;
  const injected = (window.__PINKRIBBON_DONG__ || '').trim();
  if (injected) return injected;
  const params = new URLSearchParams(window.location.search);
  const fromQuery = (params.get('dong') || params.get('area') || '').trim();
  if (fromQuery) return fromQuery;
  const match = window.location.pathname.match(/\/page\/(?:local|clog)-([a-z0-9-]+)\.php/i);
  if (match) {
    const found = localAreas.find((a) => a.slug === match[1]);
    if (found) return found.name;
  }
  return '';
}
