import { ImageWithFallback } from "./figma/ImageWithFallback";
import wineListImage from "figma:asset/19d39cf4a84f5baf4734a3b0bc0fee2444981b2e.png";
import menuImage from "figma:asset/73415e7719cfb6b3f1a0a08bb5cc78591d6d541e.png";
import { DEGUSTATION, MENU_HIGHLIGHTS } from "../data/restaurantData";
import { createScrollHandler } from "../utils/scroll";

export function Menu() {
  return (
    <section id="menu" className="py-24 bg-[#111111]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {/* Section Header */}
        <p className="taro-subheading text-center mb-3">Kulinářský zážitek</p>
        <h2 className="text-4xl md:text-5xl taro-heading text-center mb-2">
          Degustační menu
        </h2>
        <div className="taro-divider" />
        <p className="text-lg text-gray-400 max-w-2xl mx-auto text-center mb-16">
          Neustále se vyvíjející menu, které odráží sezónu a naši kreativitu
        </p>

        {/* Menu Card */}
        <div className="max-w-4xl mx-auto">
          <div className="taro-card overflow-hidden shadow-2xl">
            {/* Hero image */}
            <div className="relative h-96 overflow-hidden">
              <ImageWithFallback
                src={menuImage}
                alt="Fine dining experience"
                className="w-full h-full object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent" />
              <div className="absolute bottom-8 left-8 right-8 text-white">
                <p className="taro-subheading mb-2">Chef's Selection</p>
                <h3 className="text-4xl taro-heading">{DEGUSTATION.title}</h3>
                <p className="text-lg text-gray-300 mt-1">{DEGUSTATION.subtitle}</p>
              </div>
            </div>

            <div className="p-10 md:p-12">
              {/* Price */}
              <div className="flex items-end justify-between mb-8 pb-8 border-b border-white/10">
                <div>
                  <p className="text-5xl text-[#C8102E] mb-1">{DEGUSTATION.price}</p>
                  <p className="text-gray-500 text-sm tracking-widest uppercase">{DEGUSTATION.priceNote}</p>
                </div>
                <span className="taro-subheading">Menu zahrnuje:</span>
              </div>

              {/* Highlights */}
              <div className="space-y-5 mb-10">
                {MENU_HIGHLIGHTS.map((item) => (
                  <div key={item.title} className="flex items-start space-x-4">
                    <div className="bg-[#C8102E]/20 w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 text-[#C8102E] text-lg">
                      ✓
                    </div>
                    <div>
                      <p className="text-base text-white">{item.title}</p>
                      <p className="text-gray-500 text-sm">{item.description}</p>
                    </div>
                  </div>
                ))}
              </div>

              {/* Description */}
              <div className="bg-white/5 p-6 rounded-lg mb-8 border border-white/8">
                <p className="text-gray-400 leading-relaxed text-sm">
                  {DEGUSTATION.description}
                </p>
              </div>

              {/* CTA */}
              <div className="text-center">
                <a
                  href="#contact"
                  onClick={createScrollHandler("#contact")}
                  className="inline-block taro-btn-primary tracking-widest uppercase text-sm px-12 py-4"
                >
                  Rezervovat degustaci
                </a>
              </div>
            </div>
          </div>
        </div>

        {/* Note */}
        <p className="text-center text-gray-600 text-xs mt-8 max-w-lg mx-auto leading-relaxed">
          {DEGUSTATION.note}
        </p>

        {/* Wine List */}
        <div className="mt-24">
          <p className="taro-subheading text-center mb-3">Vinný výběr</p>
          <h3 className="text-3xl md:text-4xl taro-heading text-center mb-2">Wine List</h3>
          <div className="taro-divider" />
          <p className="text-lg text-gray-400 max-w-2xl mx-auto text-center mb-12">
            Pečlivě vybraná kolekce vín z celého světa
          </p>

          <div className="max-w-5xl mx-auto">
            <div className="taro-card overflow-hidden shadow-2xl">
              <ImageWithFallback
                src={wineListImage}
                alt="Taro Wine List"
                className="w-full h-auto object-contain"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
