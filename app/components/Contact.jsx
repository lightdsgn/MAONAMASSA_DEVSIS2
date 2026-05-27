import { useState } from "react";
import { MapPin, Phone, Mail, Clock, CheckCircle } from "lucide-react";
import { RESTAURANT_INFO } from "../data/restaurantData";

const TIME_SLOTS = [
  "17:30", "18:00", "18:30", "19:00", "19:30",
  "20:00", "20:30", "21:00", "21:30",
];

export function Contact() {
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
    setTimeout(() => setSubmitted(false), 4000);
  };

  const contactItems = [
    {
      icon: <MapPin className="text-[#C8102E]" size={22} />,
      title: "Adresa",
      content: (
        <a
          href={RESTAURANT_INFO.address.mapsUrl}
          target="_blank"
          rel="noopener noreferrer"
          className="text-gray-400 hover:text-[#C8102E] transition-colors"
        >
          {RESTAURANT_INFO.address.street}
          <br />
          {RESTAURANT_INFO.address.zip} {RESTAURANT_INFO.address.city}
          <br />
          {RESTAURANT_INFO.address.country}
        </a>
      ),
    },
    {
      icon: <Phone className="text-[#C8102E]" size={22} />,
      title: "Telefon",
      content: (
        <>
          <a
            href={`tel:${RESTAURANT_INFO.contact.phone.replace(/\s/g, "")}`}
            className="text-gray-400 hover:text-[#C8102E] transition-colors"
          >
            {RESTAURANT_INFO.contact.phone}
          </a>
          <p className="text-xs text-[#C8102E] mt-1 tracking-wide uppercase">
            Rezervace na stejný den
          </p>
        </>
      ),
    },
    {
      icon: <Mail className="text-[#C8102E]" size={22} />,
      title: "Email",
      content: (
        <a
          href={`mailto:${RESTAURANT_INFO.contact.email}`}
          className="text-gray-400 hover:text-[#C8102E] transition-colors"
        >
          {RESTAURANT_INFO.contact.email}
        </a>
      ),
    },
    {
      icon: <Clock className="text-[#C8102E]" size={22} />,
      title: "Otevírací doba",
      content: (
        <div className="space-y-1">
          {RESTAURANT_INFO.hours.map((h) => (
            <div key={h.days} className="flex justify-between gap-4">
              <span className="text-gray-500 text-sm">{h.days}</span>
              <span
                className={`text-sm ${
                  h.time === "Zavřeno" ? "text-gray-600" : "text-gray-300"
                }`}
              >
                {h.time}
              </span>
            </div>
          ))}
        </div>
      ),
    },
  ];

  return (
    <section id="contact" className="py-24 bg-[#0d0d0d]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {/* Header */}
        <p className="taro-subheading text-center mb-3">Přijďte k nám</p>
        <h2 className="text-4xl md:text-5xl taro-heading text-center mb-2">
          Kontakt &amp; Rezervace
        </h2>
        <div className="taro-divider" />
        <p className="text-lg text-gray-400 max-w-2xl mx-auto text-center mb-16">
          Těšíme se na vaší návštěvu
        </p>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">

          {/* Contact info */}
          <div className="space-y-4">
            {contactItems.map((item) => (
              <div key={item.title} className="taro-card p-6 flex items-start space-x-4">
                <div className="bg-[#C8102E]/10 p-3 rounded-lg flex-shrink-0">
                  {item.icon}
                </div>
                <div>
                  <h3 className="text-base text-white mb-1">{item.title}</h3>
                  {item.content}
                </div>
              </div>
            ))}
          </div>

          {/* Reservation form */}
          <div className="taro-card p-8 md:p-10">
            {submitted ? (
              <div className="flex flex-col items-center justify-center h-full py-16 text-center gap-4">
                <CheckCircle size={56} className="text-[#C8102E]" />
                <h3 className="text-2xl text-white">Rezervace odeslána!</h3>
                <p className="text-gray-400 text-sm">
                  Brzy se vám ozveme pro potvrzení.
                </p>
              </div>
            ) : (
              <>
                <h3 className="text-2xl taro-heading mb-8">Online rezervace</h3>
                <form className="space-y-4" onSubmit={handleSubmit}>
                  <div>
                    <label htmlFor="name" className="block text-sm text-gray-400 mb-1.5 uppercase tracking-widest">
                      Jméno a příjmení
                    </label>
                    <input
                      type="text"
                      id="name"
                      required
                      className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:outline-none focus:border-[#C8102E] text-white placeholder-gray-600 transition-colors"
                      placeholder="Vaše jméno"
                    />
                  </div>

                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label htmlFor="email" className="block text-sm text-gray-400 mb-1.5 uppercase tracking-widest">
                        Email
                      </label>
                      <input
                        type="email"
                        id="email"
                        required
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:outline-none focus:border-[#C8102E] text-white placeholder-gray-600 transition-colors"
                        placeholder="vas@email.cz"
                      />
                    </div>
                    <div>
                      <label htmlFor="phone" className="block text-sm text-gray-400 mb-1.5 uppercase tracking-widest">
                        Telefon
                      </label>
                      <input
                        type="tel"
                        id="phone"
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:outline-none focus:border-[#C8102E] text-white placeholder-gray-600 transition-colors"
                        placeholder="+420 123 456 789"
                      />
                    </div>
                  </div>

                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label htmlFor="date" className="block text-sm text-gray-400 mb-1.5 uppercase tracking-widest">
                        Datum
                      </label>
                      <input
                        type="date"
                        id="date"
                        required
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:outline-none focus:border-[#C8102E] text-white transition-colors"
                      />
                    </div>
                    <div>
                      <label htmlFor="time" className="block text-sm text-gray-400 mb-1.5 uppercase tracking-widest">
                        Čas
                      </label>
                      <select
                        id="time"
                        className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:outline-none focus:border-[#C8102E] text-white transition-colors"
                      >
                        {TIME_SLOTS.map((t) => (
                          <option key={t} value={t} className="bg-[#1a1a1a]">{t}</option>
                        ))}
                      </select>
                    </div>
                  </div>

                  <div>
                    <label htmlFor="guests" className="block text-sm text-gray-400 mb-1.5 uppercase tracking-widest">
                      Počet hostů
                    </label>
                    <select
                      id="guests"
                      className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:outline-none focus:border-[#C8102E] text-white transition-colors"
                    >
                      {["1 osoba", "2 osoby", "3 osoby", "4 osoby", "5+ osob"].map((g) => (
                        <option key={g} className="bg-[#1a1a1a]">{g}</option>
                      ))}
                    </select>
                  </div>

                  <div>
                    <label htmlFor="message" className="block text-sm text-gray-400 mb-1.5 uppercase tracking-widest">
                      Zpráva (volitelné)
                    </label>
                    <textarea
                      id="message"
                      rows={3}
                      className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:outline-none focus:border-[#C8102E] text-white placeholder-gray-600 transition-colors"
                      placeholder="Speciální požadavky nebo poznámky..."
                    />
                  </div>

                  <button
                    type="submit"
                    className="w-full taro-btn-primary py-4 tracking-widest uppercase text-sm mt-2"
                  >
                    Potvrdit rezervaci
                  </button>
                </form>
              </>
            )}
          </div>
        </div>
      </div>
    </section>
  );
}
