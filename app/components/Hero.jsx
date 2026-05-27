import { ChevronDown } from "lucide-react";
import heroImage from "../../imports/image-1.png";
import { RESTAURANT_INFO } from "../data/restaurantData";
import { scrollToSection, createScrollHandler } from "../utils/scroll";

export function Hero() {
  return (
    <section id="home" className="relative h-screen flex items-center justify-center">
      {/* Background Image */}
      <div className="absolute inset-0 z-0">
        <img
          src={heroImage}
          alt="Taro Restaurant Interior"
          className="w-full h-full object-cover"
        />
        {/* Layered overlays for depth */}
        <div className="absolute inset-0 bg-black/55" />
        <div className="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/70" />
      </div>

      {/* Decorative top border */}
      <div className="absolute top-0 left-0 right-0 h-1 bg-[#C8102E] z-20" />

      {/* Content */}
      <div className="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
        {/* Subheading */}
        <p className="taro-subheading mb-6">Fine Dining · Praha 1</p>

        <h1 className="text-6xl md:text-8xl mb-2 taro-heading tracking-tight">
          TARO
        </h1>

        <div className="taro-divider" />

        <p className="text-lg md:text-xl mb-10 max-w-2xl mx-auto text-gray-200 leading-relaxed">
          {RESTAURANT_INFO.tagline}
        </p>

        <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <a
            href="#menu"
            onClick={createScrollHandler("#menu")}
            className="taro-btn-primary text-base tracking-widest uppercase min-w-[200px] text-center"
          >
            Degustační menu
          </a>
          <a
            href="#contact"
            onClick={createScrollHandler("#contact")}
            className="taro-btn-outline text-base tracking-widest uppercase min-w-[200px] text-center"
          >
            Rezervovat stůl
          </a>
        </div>
      </div>

      {/* Scroll Indicator */}
      <button
        onClick={() => scrollToSection("#about")}
        className="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/60 hover:text-white animate-bounce z-10 transition-colors"
        aria-label="Scroll down"
      >
        <ChevronDown size={36} />
      </button>
    </section>
  );
}
