import { useState } from "react";
import { Menu, X } from "lucide-react";
import logo from "../../imports/image.png";
import { NAV_ITEMS } from "../data/restaurantData";
import { scrollToSection } from "../utils/scroll";

export function Navigation() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  const handleNav = (href) => {
    scrollToSection(href, () => setIsMenuOpen(false));
  };

  return (
    <nav className="fixed top-0 left-0 right-0 z-50 bg-[#0d0d0d]/95 backdrop-blur-sm border-b border-white/5 shadow-lg">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-20">
          {/* Logo */}
          <a
            href="#home"
            onClick={(e) => { e.preventDefault(); handleNav("#home"); }}
            className="flex items-center"
          >
            <img src={logo} alt="TARO" className="h-12" />
          </a>

          {/* Desktop Navigation */}
          <div className="hidden md:flex items-center space-x-8">
            {NAV_ITEMS.map((item) => (
              <a
                key={item.name}
                href={item.href}
                onClick={(e) => { e.preventDefault(); handleNav(item.href); }}
                className="text-gray-300 hover:text-[#C8102E] transition-colors tracking-widest uppercase text-sm"
              >
                {item.name}
              </a>
            ))}
            <a
              href="#contact"
              onClick={(e) => { e.preventDefault(); handleNav("#contact"); }}
              className="taro-btn-primary text-sm tracking-widest uppercase"
            >
              Rezervace
            </a>
          </div>

          {/* Mobile Menu Button */}
          <button
            className="md:hidden text-gray-300 hover:text-[#C8102E] transition-colors"
            onClick={() => setIsMenuOpen(!isMenuOpen)}
            aria-label="Toggle menu"
          >
            {isMenuOpen ? <X size={28} /> : <Menu size={28} />}
          </button>
        </div>
      </div>

      {/* Mobile Menu */}
      {isMenuOpen && (
        <div className="md:hidden bg-[#0d0d0d] border-t border-white/5">
          <div className="px-4 py-6 space-y-4">
            {NAV_ITEMS.map((item) => (
              <a
                key={item.name}
                href={item.href}
                onClick={(e) => { e.preventDefault(); handleNav(item.href); }}
                className="block text-gray-300 hover:text-[#C8102E] transition-colors py-2 uppercase tracking-widest text-sm"
              >
                {item.name}
              </a>
            ))}
            <a
              href="#contact"
              onClick={(e) => { e.preventDefault(); handleNav("#contact"); }}
              className="block taro-btn-primary text-center uppercase tracking-widest text-sm"
            >
              Rezervace
            </a>
          </div>
        </div>
      )}
    </nav>
  );
}
