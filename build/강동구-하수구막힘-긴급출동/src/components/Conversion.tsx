import { CheckCircle2, Clock, MapPin, Phone, Wrench } from 'lucide-react';
import {
  activeLocalArea,
  getDongFromUrl,
  isClogFocus,
  localAreas,
  localAreaUrl,
  localClogUrl,
  phoneCtaLabel,
  phoneCtaSubLabel,
  regionName,
  relatedCleanUrl,
  relatedClogUrl,
  telHref,
} from '../data';

const guideLinks = [
  {
    href: '/page/guide-drain-cost.php',
    title: '하수구청소 비용이 달라지는 기준',
    answer: '막힘 위치, 배관 길이, 오염 정도와 필요한 장비 범위에 따라 달라집니다.',
  },
  {
    href: '/page/guide-slow-sink.php',
    title: '싱크대 물이 천천히 내려갈 때',
    answer: '입구 청소 후에도 반복되면 배관 안쪽 기름때와 이물질을 확인해야 합니다.',
  },
  {
    href: '/page/guide-toilet-overflow.php',
    title: '변기 물이 차오를 때',
    answer: '다시 물을 내리지 말고 급수 밸브를 잠근 뒤 주변의 물 사용을 줄이세요.',
  },
  {
    href: '/page/guide-drain-odor.php',
    title: '배수구 악취 원인과 관리',
    answer: '트랩의 물, 입구 오염, 연결부 틈과 배관 내부 상태를 순서대로 확인합니다.',
  },
  {
    href: '/page/guide-restaurant-drain.php',
    title: '음식점 주방 배관 관리',
    answer: '배수 시간과 그리스트랩 상태를 기록해 업종과 사용량에 맞는 주기를 정합니다.',
  },
  {
    href: '/page/guide-plunger-failure.php',
    title: '뚫어뻥으로 해결되지 않는 이유',
    answer: '깊은 막힘, 단단한 이물질과 공용 배관 문제는 압축만으로 해결하기 어렵습니다.',
  },
];

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
              <article
                key={item.slug}
                className="rounded-3xl border border-slate-200 bg-slate-50 p-6 hover:border-orange-400 hover:bg-white hover:shadow-xl transition-all"
              >
                <span className="inline-flex mb-4 px-3 py-1.5 rounded-full bg-orange-100 text-orange-600 text-xs font-extrabold">
                  {item.label}
                </span>
                <h3 className="text-xl font-black text-slate-900 mb-3 break-keep">{item.guide_title}</h3>
                <p className="text-slate-600 text-sm font-medium leading-relaxed line-clamp-3 break-keep">
                  {item.guide_body}
                </p>
                <div className="mt-5 flex flex-wrap gap-3">
                  <a href={localAreaUrl(item)} className="inline-flex items-center gap-1 text-orange-600 font-extrabold text-sm">
                    하수구청소 안내 →
                  </a>
                  <a href={localClogUrl(item)} className="inline-flex items-center gap-1 text-slate-700 font-extrabold text-sm">
                    하수구막힘 안내 →
                  </a>
                </div>
              </article>
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
          <span aria-current="page" className="text-slate-800">
            {area.name} {isClogFocus ? '하수구막힘' : '하수구청소'}
          </span>
        </nav>

        <div className="grid lg:grid-cols-[1.2fr_.8fr] gap-8 items-start">
          <article>
            <p className="text-orange-500 font-extrabold tracking-widest text-sm mb-3">
              {isClogFocus ? 'LOCAL CLOG GUIDE' : 'LOCAL DRAIN GUIDE'}
            </p>
            <h2 className="text-3xl md:text-5xl font-black text-slate-900 tracking-tight break-keep mb-6">
              {area.guide_title}
            </h2>
            <p className="text-slate-600 text-lg font-medium leading-relaxed break-keep mb-8">
              {area.guide_body}
            </p>

            <h3 className="text-xl font-black text-slate-900 mb-4">
              {area.name}에서 자주 확인하는 {isClogFocus ? '막힘 증상' : '증상'}
            </h3>
            <ul className="grid sm:grid-cols-2 gap-3">
              {(area.issues || []).map((issue) => (
                <li key={issue} className="flex items-start gap-3 rounded-2xl bg-slate-50 border border-slate-100 p-4 text-slate-700 font-bold">
                  <CheckCircle2 className="w-5 h-5 text-orange-500 shrink-0 mt-0.5" />
                  {issue}
                </li>
              ))}
            </ul>

            <div className="mt-8 flex flex-wrap gap-3">
              {isClogFocus ? (
                <a
                  href={relatedCleanUrl(area)}
                  className="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800 hover:border-orange-400 hover:text-orange-600"
                >
                  {area.name} 하수구청소 안내 보기
                </a>
              ) : (
                <a
                  href={relatedClogUrl(area)}
                  className="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-extrabold text-slate-800 hover:border-orange-400 hover:text-orange-600"
                >
                  {area.name} 하수구막힘 안내 보기
                </a>
              )}
            </div>
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

export const GuideHub = () => (
  <section id="guide-hub" className="py-20 md:py-28 bg-slate-50 scroll-mt-20">
    <div className="max-w-7xl mx-auto px-4">
      <div className="max-w-3xl mb-10">
        <p className="text-orange-500 font-extrabold tracking-widest text-sm mb-3">DRAIN ANSWER GUIDE</p>
        <h2 className="text-3xl md:text-5xl font-black text-slate-900 tracking-tight break-keep mb-5">
          증상별 핵심 답변과 안전한 확인 순서
        </h2>
        <p className="text-slate-600 text-lg font-medium leading-relaxed break-keep">
          비용을 단정하거나 무리한 자가 작업을 권하지 않습니다. 현재 증상에 가까운 안내에서
          원인 범위와 전화상담 전 확인할 내용을 먼저 살펴보세요.
        </p>
      </div>
      <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        {guideLinks.map((guide) => (
          <article key={guide.href} className="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 className="text-xl font-black text-slate-900 mb-3 break-keep">{guide.title}</h3>
            <p className="text-slate-600 text-sm font-medium leading-relaxed break-keep">{guide.answer}</p>
            <a
              href={guide.href}
              className="mt-5 inline-flex items-center gap-1 text-orange-600 font-extrabold text-sm hover:text-orange-700"
              aria-label={`${guide.title} 안내 자세히 보기`}
            >
              확인 순서 보기 →
            </a>
          </article>
        ))}
      </div>
    </div>
  </section>
);
