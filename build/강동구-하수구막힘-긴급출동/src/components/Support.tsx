import { useState } from 'react';
import { motion, AnimatePresence } from 'motion/react';
import { ChevronDown, ShieldAlert, PhoneCall } from 'lucide-react';
import { activeLocalArea, assetUrl, contactInfo, getDongFromUrl, keywords, phoneCtaLabel, phoneCtaSubLabel, regionName, siteFaqs, telHref } from '../data';

export const Notices = () => {
  const promises = [
    { num: '01', title: '증상 확인', desc: '막힌 위치와 물 내려가는 상태 확인' },
    { num: '02', title: '배관 점검', desc: '현장 구조에 맞춰 원인과 범위 확인' },
    { num: '03', title: '배수 확인', desc: '작업 후 물 흐름과 관리 방법 안내' },
  ];

  return (
    <section id="notices" className="py-20 md:py-28 bg-white scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4">
        <div className="grid lg:grid-cols-2 rounded-[2rem] md:rounded-[2.5rem] overflow-hidden bg-slate-950 shadow-2xl">
          <div className="relative min-h-[380px] lg:min-h-[600px]">
            <img
              src={assetUrl('commercial-drain.webp')}
              alt="상가 하수구 현장 점검"
              className="absolute inset-0 w-full h-full object-cover"
              width={1600}
              height={1066}
              loading="lazy"
              decoding="async"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent" />
            <div className="absolute left-6 right-6 bottom-6 md:left-8 md:bottom-8">
              <span className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500 text-white font-extrabold text-sm">
                <ShieldAlert className="w-4 h-4" /> 현장 원칙
              </span>
            </div>
          </div>

          <div className="p-7 md:p-12 lg:p-14 flex flex-col justify-center">
            <p className="text-orange-400 font-extrabold tracking-widest text-sm mb-3">OUR PROMISE</p>
            <h2 className="text-3xl md:text-5xl font-black text-white tracking-tight leading-tight mb-10 break-keep">
              증상부터 배관까지<br />순서대로 확인
            </h2>
            <div className="space-y-3">
              {promises.map((item) => (
                <div key={item.num} className="flex items-center gap-4 p-4 md:p-5 rounded-2xl bg-white/5 border border-white/10">
                  <strong className="text-orange-400 font-black text-xl">{item.num}</strong>
                  <div>
                    <h3 className="text-white font-extrabold text-lg">{item.title}</h3>
                    <p className="text-slate-400 text-sm font-medium break-keep">{item.desc}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export const FAQ = () => {
  const localFaqs = (activeLocalArea?.faq || []).map((item) => ({
    q: item.question,
    a: item.answer,
  }));
  const commonFaqs = siteFaqs.length
    ? siteFaqs.map((item) => ({ q: item.question, a: item.answer }))
    : [
        {
          q: `${regionName} 하수구청소 비용은 어떻게 정해지나요?`,
          a: '배관 길이, 막힘 위치와 정도, 필요한 장비와 작업 범위에 따라 달라집니다. 현장 확인 후 작업 전 범위와 비용을 안내받는 것이 안전합니다.',
        },
        {
          q: '뚫어뻥으로 해결되지 않으면 어떻게 해야 하나요?',
          a: '배관 깊은 곳의 이물질이나 기름층이 원인일 수 있습니다. 반복해서 압력을 가하기보다 여러 배수구의 증상을 확인한 뒤 상담해 주세요.',
        },
      ];
  const faqs = [
    ...localFaqs,
    ...commonFaqs,
  ];

  const [openIdx, setOpenIdx] = useState<number | null>(0);

  return (
    <section id="faq" className="py-24 bg-slate-50 scroll-mt-20">
      <div className="max-w-3xl mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-5">
            {keywords.main} 자주 묻는 질문
          </h2>
        </div>

        <div className="space-y-4">
          {faqs.map((faq, idx) => (
            <div key={idx} className="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm transition-shadow hover:shadow-md">
              <button
                onClick={() => setOpenIdx(openIdx === idx ? null : idx)}
                className="w-full flex items-center justify-between p-6 md:p-8 text-left focus:outline-none"
              >
                <span className="font-bold text-slate-900 text-base md:text-lg pr-4 break-keep">Q. {faq.q}</span>
                <ChevronDown className={`w-6 h-6 text-slate-400 shrink-0 transition-transform duration-300 ${openIdx === idx ? 'rotate-180' : ''}`} />
              </button>
              <AnimatePresence>
                {openIdx === idx && (
                  <motion.div
                    initial={{ height: 0, opacity: 0 }}
                    animate={{ height: 'auto', opacity: 1 }}
                    exit={{ height: 0, opacity: 0 }}
                    className="overflow-hidden"
                  >
                    <div className="px-6 md:px-8 pb-8 text-slate-600 bg-slate-50/50 border-t border-slate-100">
                      <div className="pt-6 font-medium leading-relaxed break-keep mb-5">A. {faq.a}</div>
                      <div className="flex flex-col sm:flex-row gap-2">
                        <a
                          href={telHref()}
                          className="inline-flex flex-col items-center justify-center gap-0.5 bg-orange-500 hover:bg-orange-600 text-white px-4 py-3 rounded-xl text-sm font-extrabold leading-none"
                        >
                          <span className="inline-flex items-center gap-1.5 text-xs opacity-95">
                            <PhoneCall className="w-3.5 h-3.5" />
                            {phoneCtaSubLabel(regionName)}
                          </span>
                          <span className="text-lg tracking-tight">{phoneCtaLabel(regionName)}</span>
                        </a>
                      </div>
                    </div>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export const FinalCTA = () => {
  const area = getDongFromUrl() || regionName;
  return (
    <section id="contact" className="py-24 md:py-32 bg-slate-900 relative overflow-hidden scroll-mt-20">
      <img
        src={assetUrl('drain-hero.webp')}
        alt=""
        className="absolute inset-0 w-full h-full object-cover object-[70%_center]"
        width={1600}
        height={1066}
        loading="lazy"
        decoding="async"
      />
      <div className="absolute inset-0 bg-slate-950/80"></div>
      <div className="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 className="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight tracking-tight break-keep">
          {area} 하수구청소,<br className="hidden md:block" /> 지금 바로 전화하세요
        </h2>
        <p className="text-slate-300 text-lg mb-10 font-medium break-keep leading-relaxed max-w-2xl mx-auto">
          {contactInfo.companyName} · {regionName} 하수구청소. 증상과 위치를 전화로 알려주시면 필요한 청소·작업 방향을 안내합니다.
        </p>

        <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
          <a
            href={telHref()}
            className="w-full sm:w-auto flex flex-col items-center justify-center gap-1 bg-orange-500 hover:bg-orange-600 text-white px-8 py-5 rounded-2xl font-extrabold transition-all hover:-translate-y-1 shadow-lg shadow-orange-500/30 border border-orange-500 leading-none"
          >
            <span className="inline-flex items-center gap-2 text-sm opacity-95">
              <PhoneCall className="w-5 h-5" />
              {phoneCtaSubLabel(area)}
            </span>
            <span className="text-3xl md:text-4xl tracking-tight">{phoneCtaLabel(area)}</span>
          </a>
        </div>
      </div>
    </section>
  );
};

export const Footer = () => {
  return (
    <footer className="bg-slate-950 text-slate-500 py-16 text-sm border-t border-slate-900">
      <div className="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between gap-10">
        <div>
          <h3 className="text-slate-300 font-extrabold text-xl mb-5">{contactInfo.companyName}</h3>
          <div className="space-y-2 font-medium">
            {(contactInfo.ceo || contactInfo.businessNumber) && (
              <p>
                {contactInfo.ceo ? `대표: ${contactInfo.ceo}` : ''}
                {contactInfo.ceo && contactInfo.businessNumber ? ' | ' : ''}
                {contactInfo.businessNumber ? `사업자등록번호: ${contactInfo.businessNumber}` : ''}
              </p>
            )}
            {contactInfo.address && <p>주소: {contactInfo.address}</p>}
            <p className="text-slate-300">
              고객센터:{' '}
              <a href={telHref()} className="text-orange-400 font-extrabold text-lg hover:text-orange-300">
                {contactInfo.phoneFormatted}
              </a>
            </p>
          </div>
        </div>
        <div className="md:text-right font-medium flex flex-col justify-between">
          <p className="mb-6">
            본 사이트는 정보 제공을 목적으로 하며,<br className="hidden md:block" />
            서비스 제공에 따른 책임은 당사에 있습니다.
          </p>
          <p>&copy; {new Date().getFullYear()} {contactInfo.companyName}. All rights reserved.</p>
        </div>
      </div>
    </footer>
  );
};
