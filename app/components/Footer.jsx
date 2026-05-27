import { Instagram } from "lucide-react";
import logo from "../../imports/image.png";
import { RESTAURANT_INFO, NAV_ITEMS, FOOTER_NOTES } from "../data/restaurantData";

export function Footer() {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-[#111111] text-white border-t border-white/5">
      {/* Top red bar */}
      <div className="h-1 bg-[#C8102E]" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">

          {/* Brand */}
          <div>
            <img src={logo} alt="TARO" className="h-12 mb-6" />
            <div className="space-y-2 text-sm text-gray-500 leading-relaxed">
              {FOOTER_NOTES.map((note, i) => (
                <p key={i} className={i === FOOTER_NOTES.length - 1 ? "text-[#C8102E]/80" : ""}>
                  {note}
                </p>
              ))}
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="taro-subheading mb-6">Rychlé odkazy</h4>
            <ul className="space-y-3">
              {NAV_ITEMS.map((item) => (
                <li key={item.name}>
                  <a
                    href={item.href}
                    className="text-gray-500 hover:text-[#C8102E] transition-colors text-sm tracking-wide"
                  >
                    {item.name}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Contact & Social */}
          <div>
            <h4 className="taro-subheading mb-6">Kontakt</h4>
            <div className="space-y-2 text-sm text-gray-500 mb-6">
              <p>
                <a
                  href={`mailto:${RESTAURANT_INFO.contact.email}`}
                  className="hover:text-[#C8102E] transition-colors"
                >
                  {RESTAURANT_INFO.contact.email}
                </a>
              </p>
              <p>
                <a
                  href={`tel:${RESTAURANT_INFO.contact.phone.replace(/\s/g, "")}`}
                  className="hover:text-[#C8102E] transition-colors"
                >
                  {RESTAURANT_INFO.contact.phone}
                </a>
              </p>
              <p className="text-gray-600">
                {RESTAURANT_INFO.address.street}, {RESTAURANT_INFO.address.city}
              </p>
            </div>

            <h4 className="taro-subheading mb-4">Sledujte nás</h4>
            <div className="flex items-center gap-3">
              <a
                href={RESTAURANT_INFO.social.instagram}
                target="_blank"
                rel="noopener noreferrer"
                className="bg-white/5 p-3 rounded-full hover:bg-[#C8102E] transition-colors border border-white/10 hover:border-[#C8102E]"
                aria-label="Instagram TARO Prague"
              >
                <Instagram size={18} />
              </a>
              <a
                href={RESTAURANT_INFO.social.instagram}
                target="_blank"
                rel="noopener noreferrer"
                className="text-gray-500 hover:text-[#C8102E] transition-colors text-sm"
              >
                {RESTAURANT_INFO.social.instagramHandle}
              </a>
            </div>
          </div>
        </div>

        {/* Bottom bar */}
        <div className="border-t border-white/5 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
          <p className="text-gray-600 text-xs">
            &copy; {currentYear} Restaurace TARO. Všechna práva vyhrazena.
          </p>
          <p className="text-gray-700 text-xs">
            {RESTAURANT_INFO.address.street} · {RESTAURANT_INFO.address.zip} {RESTAURANT_INFO.address.city}
          </p>
        </div>
      </div>
    </footer>
  );
}
