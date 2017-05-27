export const url = process.env.DEVELOPMENT ? 'http://localhost/' : 'http://pixelslash.xaa.pl/';
export const path = process.env.DEVELOPMENT ? 'pixelslash/' : '';
export const getStats = `${path}api/get_stats.php`;
export const atack = `${path}api/attack.php`;
