import { url, getStats, attack } from '../constans/pixelslash';
import Api from '../api_client';

export function fetchStats() {
  return Api.init({
    url,
    pathname: getStats,
  });
}

export function doAttack() {
  return Api.init({
    url,
    pathname: attack,
  });
}
