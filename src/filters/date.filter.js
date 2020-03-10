export default function dateFilter(value, format = "time") {
  const opt = {};
  if (format.includes("date")) {
    (opt.day = "2-digit"), (opt.month = "long"), (opt.year = "numeric");
  }
  if (format.includes("time")) {
    (opt.hour = "2-digit"), (opt.minute = "2-digit"), (opt.second = "2-digit");
  }
  return new Intl.DateTimeFormat("ru-RU", opt).format(new Date(value));
}
