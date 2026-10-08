# 검색 통계

Google Search Console과 Bing Webmaster Tools에서 수집한 검색 성과 보고서를 보관한다.

- 날짜별 보고서: `YYYY-MM-DD-report.md`
- 최신 보고서: `latest-summary.md`
- 원본 CSV: `data/`

OAuth 클라이언트 설정과 로그인 토큰은 이 저장소에 보관하지 않는다. Windows 로컬 사용자 폴더의 `AppData\Local\SubcultureGamerStats`에만 둔다.

## 한 번에 갱신

Google과 Bing의 최근 28일 통계를 함께 갱신:

```powershell
node tools/blog-stats.mjs --days 28
```

대화에서 `/stats 최근 28일`이라고 요청해도 같은 수집 과정을 실행한다.

## Google Search Console

최초 인증만 수행:

```powershell
node tools/search-console-stats.mjs --auth-only
```

최근 28일과 직전 28일을 비교해 수집:

```powershell
node tools/search-console-stats.mjs --days 28
```

Search Console 데이터 확정 지연을 고려해 기본 종료일은 실행일 3일 전이다.

## Bing Webmaster Tools

기존 API 키를 저장소 밖의 로컬 폴더에 저장:

```powershell
node tools/save-bing-key.mjs
```

접근 가능한 사이트 확인:

```powershell
node tools/bing-webmaster-stats.mjs --list-sites
```

최근 28일 범위의 페이지·검색어 통계 수집:

```powershell
node tools/bing-webmaster-stats.mjs --days 28
```

Bing의 페이지·검색어 상세 통계는 주 단위로 갱신될 수 있다. Google과 Bing 수치는 집계 기준이 다르므로 직접 합산하지 않는다.
