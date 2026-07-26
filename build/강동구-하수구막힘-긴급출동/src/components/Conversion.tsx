import { CheckCircle2, Clock, MapPin, Phone, Wrench } from 'lucide-react';
import {
  activeLocalArea,
  getDongFromUrl,
  localAreas,
  localAreaUrl,
  phoneCtaLabel,
  phoneCtaSubLabel,
  regionName,
  telHref,
} from '../data';

export const TrustSignals = () => (
  <div className="flex flex-wrap gap-2">
    <span className="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-orange-500 text-white text-sm font-extrabold shadow-lg shadow-orange-500/30">
      <Phone className="w-4 h-4" /> 전화상담 전용
    </span>
    <span className="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white text-sm font-bold">
      <MapPin className="w-4 h-4 text-orange-400" /> {regionName} 지역 안내
    </span>
    <span className="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-white/10 border border-white/20 text-white text-sm font-bold">
      <Wrench className="w-4 h-4 text-orange-400" /> 하수구·배수구 점검
    </span>
  </div>
);

export const PhoneCta = ({
  area,
  className = '',
  size = 'md',
}: {
  area?: string;
  className?: string;
  size?: 'sm' | 'md' | 'lg';
}) => {
  const targetArea = area || getDongFromUrl() || regionName;
  const pad = size === 'lg' ? 'px-8 py-5' : size === 'sm' ? 'px-4 py-3' : 'px-6 py-4';
  const numberSize = size === 'lg' ? 'text-3xl' : size === 'sm' ? 'text-xl' : 'text-2xl';

  return (
    <a
      href={telHref()}
      className={`inline-flex flex-col items-center justify-center gap-1 bg-orange-500 hover:bg-orange-600 text-white rounded-2xl font-extrabold transition-all shadow-lg shadow-orange-500/25 leading-none ${pad} ${className}`}
    >
      <span className="inline-flex items-center gap-1.5 text-xs sm:text-sm opacity-95">
        <Phone className="w-4 h-4" />
        {phoneCtaSubLabel(targetArea)}
      </span>
      <span className={`${numberSize} tracking-tight`}>{phoneCtaLabel(targetArea)}</span>
    </a>
  );
};

export const NeighborhoodGuide = () => {
  const area = activeLocalArea;

  if (!area) {
    return (
      <section id="area-guide" className="py-20 md:py-28 bg-white scroll-mt-20">
        <div className="max-w-7xl mx-auto px-4">
          <div className="max-w-3xl mb-10">
            <p className="text-orange-500 font-extrabold tracking-widest text-sm mb-3">GURI AREA GUIDE</p>
            <h2 className="text-3xl md:text-5xl font-black text-slate-900 tracking-tight break-keep mb-5">
              구리 동네별 배관 환경 안내
            </h2>
            <p className="text-slate-600 text-lg font-medium leading-relaxed break-keep">
              아파트 중심 지역과 주택·상가가 섞인 지역은 자주 발생하는 배수 문제가 다릅니다.
              거주지에 가까운 페이지에서 동별 점검 포인트를 확인하세요.
            </p>
          </div>
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            {localAreas.map((item) => (
              <a
                key={item.slug}
                href={localAreaUrl(item)}
                className="group rounded-3xl border border-slate-200 bg-slate-50 p-6 hover:border-orange-400 hover:bg-white hover:shadow-xl transition-all"
              >
                <span className="inline-flex mb-4 px-3 py-1.5 rounded-full bg-orange-100 text-orange-600 text-xs font-extrabold">
                  {item.label}
                </span>
                <h3 className="text-xl font-black text-slate-900 mb-3 break-keep">{item.guide_title}</h3>
                <p className="text-slate-600 text-sm font-medium leading-relaxed line-clamp-3 break-keep">
                  {item.guide_body}
                </p>
                <span className="mt-5 inline-flex items-center gap-1 text-orange-600 font-extrabold text-sm">
                  지역 안내 보기 →
                </span>
              </a>
            ))}
          </div>
        </div>
      </section>
    );
  }

  return (
    <section id="area-guide" className="py-20 md:py-28 bg-white scroll-mt-20">
      <div className="max-w-6xl mx-auto px-4">
        <nav aria-label="현재 위치" className="text-sm text-slate-500 font-medium mb-8">
          <a href="/" className="hover:text-orange-600">홈</a>
          <span className="mx-2">/</span>
          <a href="/#areas" className="hover:text-orange-600">{regionName}</a>
          <span className="mx-2">/</span>
          <span aria-current="page" className="text-slate-800">{area.name} 하수구청소</span>
        </nav>

        <div className="grid lg:grid-cols-[1.2fr_.8fr] gap-8 items-start">
          <article>
            <p className="text-orange-500 font-extrabold tracking-widest text-sm mb-3">LOCAL DRAIN GUIDE</p>
            <h2 className="text-3xl md:text-5xl font-black text-slate-900 tracking-tight break-keep mb-6">
              {area.guide_title}
            </h2>
            <p className="text-slate-600 text-lg font-medium leading-relaxed break-keep mb-8">
              {area.guide_body}
            </p>

            <h3 className="text-xl font-black text-slate-900 mb-4">{area.name}에서 자주 확인하는 증상</h3>
            <ul className="grid sm:grid-cols-2 gap-3">
              {(area.issues || []).map((issue) => (
                <li key={issue} className="flex items-start gap-3 rounded-2xl bg-slate-50 border border-slate-100 p-4 text-slate-700 font-bold">
                  <CheckCircle2 className="w-5 h-5 text-orange-500 shrink-0 mt-0.5" />
                  {issue}
                </li>
              ))}
            </ul>
          </article>

          <aside className="rounded-[2rem] bg-slate-900 text-white p-7 md:p-8 shadow-xl">
            <div className="flex items-center gap-2 text-orange-400 font-extrabold mb-5">
              <MapPin className="w-5 h-5" /> 안내 생활권
            </div>
            <ul className="space-y-3 mb-8">
              {(area.spots || []).map((spot) => (
                <li key={spot} className="flex items-center gap-3 text-slate-200 font-semibold">
                  <span className="w-1.5 h-1.5 rounded-full bg-orange-500" />
                  {spot}
                </li>
              ))}
            </ul>
            <div className="flex items-start gap-3 rounded-2xl bg-white/5 border border-white/10 p-4 mb-6">
              <Clock className="w-5 h-5 text-orange-400 shrink-0 mt-0.5" />
              <p className="text-sm text-slate-300 leading-relaxed">
                위치와 증상, 물이 내려가는 속도를 전화로 알려주시면 확인 항목을 안내합니다.
              </p>
            </div>
            <PhoneCta area={area.name} className="w-full" />
          </aside>
        </div>
      </div>
    </section>
  );
};
