/**
 * Centralized restaurant data for TARO restaurant
 * Národní 10, Praha 1
 */

export const RESTAURANT_INFO = {
  name: "TARO",
  tagline: "Odvážný pohled na vietnamskou kuchyni tak, jak ji známe z dětství",
  address: {
    street: "Národní 10",
    zip: "110 00",
    city: "Praha 1",
    country: "Česká republika",
    mapsUrl: "https://maps.google.com/?q=Národní+10,+Praha+1",
  },
  contact: {
    phone: "+420 777 446 007",
    email: "info@taro.cz",
  },
  social: {
    instagram: "https://www.instagram.com/taroprague/",
    instagramHandle: "@taroprague",
  },
  hours: [
    { days: "Úterý – Pátek", time: "17:30 – 23:00" },
    { days: "Sobota (oběd)", time: "12:00 – 15:00" },
    { days: "Sobota (večeře)", time: "17:30 – 23:00" },
    { days: "Neděle & Pondělí", time: "Zavřeno" },
  ],
};

export const NAV_ITEMS = [
  { name: "Domů", href: "#home" },
  { name: "O nás", href: "#about" },
  { name: "Menu", href: "#menu" },
  { name: "Galerie", href: "#gallery" },
  { name: "Poukazy", href: "#vouchers" },
  { name: "Kontakt", href: "#contact" },
];

export const TEAM = [
  {
    name: "Khanh",
    role: "Šéfkuchař",
    quote:
      "Každé jídlo, které podáváme, je odrazem mých kořenů, experimentů a osobního pohledu na to, jak by vietnamská kuchyně měla být vnímána.",
    description: "Stojí za ohněm a chutěmi.",
  },
  {
    name: "Giang",
    role: "Frontman",
    quote:
      "Pokud jste u nás, chci, abyste se cítili jako doma – se sklenkou v ruce a v atmosféře, která vás přiměje vrátit se zas a znova.",
    description: "Řídí dění na place.",
  },
];

export const MENU_HIGHLIGHTS = [
  {
    title: "Welcome drink",
    description: "Uvítací nápoj pro zahájení večera",
  },
  {
    title: "Snacks",
    description: "Delikátní předkrmy před hlavním menu",
  },
  {
    title: "5 chodů",
    description: "Pečlivě připravená degustační nabídka ze sezónních surovin",
  },
];

export const DEGUSTATION = {
  title: "5 Course Chef's Menu",
  subtitle: "Odvážný zážitek vietnamské kuchyně",
  price: "2550 Kč",
  priceNote: "na osobu",
  description:
    "Naše menu se neustále vyvíjí s ohledem na sezónu a dostupnost těch nejčerstvějších surovin. Každý chod je pečlivě navržen tak, aby vyprovokoval vaše smysly a přinesl vám nový pohled na vietnamskou kuchyň.",
  note: "Menu se může měnit podle dostupnosti sezónních surovin. Pro speciální dietní požadavky nás prosím kontaktujte předem.",
};

export const VOUCHER_AMOUNTS = [
  "2 000 Kč",
  "3 000 Kč",
  "4 000 Kč",
  "5 000 Kč",
  "6 000 Kč",
  "7 000 Kč",
  "8 000 Kč",
];

export const FOOTER_NOTES = [
  "Alergeny a omezení hlaste předem.",
  "Složitější kombinace s námi prosím proberte telefonicky.",
  "Vegetariánskou i pescateriánskou verzi nabízíme.",
];

export const COLORS = {
  primary: "#C8102E",
  dark: "#0D0D0D",
  darkAlt: "#1a1a1a",
  gold: "#b8974a",
};