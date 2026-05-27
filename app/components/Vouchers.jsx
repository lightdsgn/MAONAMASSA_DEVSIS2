import voucher2000 from "figma:asset/158d4c7c6dd59acf5f46f9ae6a4f0d9ca963c00f.png";
import voucher3000 from "figma:asset/0bf2f17c1db572f3fb420155bbe6f0c5b3877905.png";
import voucher4000 from "figma:asset/30f6b7e63c9e5f767f1536c21e9ef6c468e24e7d.png";
import voucher5000 from "figma:asset/784393874a65aa0bd53a67b0b3aaa353a399857b.png";
import voucher6000 from "figma:asset/e02e840bf7164866e186c45237e12d2f9c42ed1a.png";
import voucher7000 from "figma:asset/c9729dbe036758691fdb1a1b524ff6917c14487d.png";
import voucher8000 from "figma:asset/be57350b0f68677381a296cff7481740bf4d3fe0.png";
import experienceVoucher from "figma:asset/e70dfa53c4d795e120edcee9dc2c7674248abae7.png";
import { createScrollHandler } from "../utils/scroll";

const VOUCHERS = [
  { amount: "2 000 Kč", image: voucher2000 },
  { amount: "3 000 Kč", image: voucher3000 },
  { amount: "4 000 Kč", image: voucher4000 },
  { amount: "5 000 Kč", image: voucher5000 },
  { amount: "6 000 Kč", image: voucher6000 },
  { amount: "7 000 Kč", image: voucher7000 },
  { amount: "8 000 Kč", image: voucher8000 },
];

function VoucherCard({ src, alt, label }) {
  return (
    <div className="taro-card overflow-hidden group hover:scale-[1.03] transition-all duration-300 hover:border-[#C8102E]/40">
      <div className="overflow-hidden">
        <img
          src={src}
          alt={alt}
          className="w-full h-auto group-hover:scale-105 transition-transform duration-500"
        />
      </div>
      <div className="p-4 text-center border-t border-white/5">
        <p className="text-white text-sm tracking-wide">{label}</p>
      </div>
    </div>
  );
}

export function Vouchers() {
  return (
    <section id="vouchers" className="py-24 bg-[#111111]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {/* Header */}
        <p className="taro-subheading text-center mb-3">Darujte zážitek</p>
        <h2 className="text-4xl md:text-5xl taro-heading text-center mb-2">Dárkové poukazy</h2>
        <div className="taro-divider" />
        <p className="text-lg text-gray-400 max-w-2xl mx-auto text-center mb-16">
          Darujte nezapomenutelný kulinářský zážitek
        </p>

        {/* Experience Voucher */}
        <div className="mb-20">
          <h3 className="text-2xl taro-heading text-center mb-10">Poukaz na zážitek</h3>
          <div className="max-w-sm mx-auto">
            <VoucherCard
              src={experienceVoucher}
              alt="Poukázka na zážitek"
              label="Pětichodové chef's menu + Welcome Drink pro 2 osoby"
            />
          </div>
        </div>

        {/* Amount Vouchers */}
        <div>
          <h3 className="text-2xl taro-heading text-center mb-10">Poukazy na částku</h3>

          {/* First row: 4 cards */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            {VOUCHERS.slice(0, 4).map((v) => (
              <VoucherCard
                key={v.amount}
                src={v.image}
                alt={`Poukázka na ${v.amount}`}
                label={`Poukázka na ${v.amount}`}
              />
            ))}
          </div>

          {/* Second row: 3 cards centered */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
            {VOUCHERS.slice(4).map((v) => (
              <VoucherCard
                key={v.amount}
                src={v.image}
                alt={`Poukázka na ${v.amount}`}
                label={`Poukázka na ${v.amount}`}
              />
            ))}
          </div>
        </div>

        {/* CTA */}
        <div className="text-center mt-14">
          <p className="text-gray-500 text-sm mb-6">
            Pro zakoupení poukazu nás kontaktujte telefonicky nebo emailem
          </p>
          <a
            href="#contact"
            onClick={createScrollHandler("#contact")}
            className="inline-block taro-btn-primary tracking-widest uppercase text-sm"
          >
            Kontaktovat nás
          </a>
        </div>
      </div>
    </section>
  );
}
