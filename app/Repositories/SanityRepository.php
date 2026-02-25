<?php

namespace App\Repositories;

use App\Services\Sanity;

class SanityRepository
{
    public function __construct(private readonly Sanity $sanity)
    {
    }

    public function siteSettings(int $cacheSeconds = 900): ?array
    {
        $query = <<<'GROQ'
*[_type == "siteSettings" && _id == "siteSettings"][0]{
  _id,
  siteTitle,
  tagline,
  contactEmail,
  contactPhone,
  "logoUrl": logo.asset->url,
  primaryNavigation[]{
    label,
    href,
    newTab
  },
  defaultSeo
}
GROQ;

        return $this->firstResult($query, [], $cacheSeconds);
    }

    public function pageBySlug(string $slug, int $cacheSeconds = 600): ?array
    {
        $query = <<<'GROQ'
*[_type == "page" && slug.current == $slug][0]{
  _id,
  title,
  "slug": slug.current,
  headline,
  hero{
    mediaType,
    vimeoId,
    overlayOpacity,
    "imageUrl": image.asset->url,
    "posterUrl": poster.asset->url,
    "imageAlt": image.alt
  },
  body,
  seo
}
GROQ;

        return $this->firstResult($query, ['slug' => $slug], $cacheSeconds);
    }

    public function services(int $cacheSeconds = 600): array
    {
        $query = <<<'GROQ'
*[_type == "service"]|order(displayOrder asc){
  _id,
  title,
  "slug": slug.current,
  summary,
  headline,
  displayOrder,
  hero{
    mediaType,
    vimeoId,
    overlayOpacity,
    "imageUrl": image.asset->url,
    "posterUrl": poster.asset->url,
    "imageAlt": image.alt
  }
}
GROQ;

        return $this->listResult($query, [], $cacheSeconds);
    }

    public function serviceBySlug(string $slug, int $cacheSeconds = 600): ?array
    {
        $query = <<<'GROQ'
*[_type == "service" && slug.current == $slug][0]{
  _id,
  title,
  "slug": slug.current,
  summary,
  headline,
  description,
  keyBenefits,
  hero{
    mediaType,
    vimeoId,
    overlayOpacity,
    "imageUrl": image.asset->url,
    "posterUrl": poster.asset->url,
    "imageAlt": image.alt
  },
  featuredPortfolio[]->{
    _id,
    title,
    "slug": slug.current,
    summary,
    vimeoId,
    "posterUrl": poster.asset->url
  },
  seo
}
GROQ;

        return $this->firstResult($query, ['slug' => $slug], $cacheSeconds);
    }

    public function portfolioCategories(int $cacheSeconds = 600): array
    {
        $query = <<<'GROQ'
*[_type == "portfolioCategory"]|order(displayOrder asc){
  _id,
  title,
  "slug": slug.current,
  description,
  displayOrder
}
GROQ;

        return $this->listResult($query, [], $cacheSeconds);
    }

    public function portfolioItems(?string $categorySlug = null, int $limit = 24, int $cacheSeconds = 600): array
    {
        $query = <<<'GROQ'
*[
  _type == "portfolioItem" &&
  (
    !defined($categorySlug) ||
    category->slug.current == $categorySlug
  )
]|order(featured desc, publishedAt desc)[0...$limit]{
  _id,
  title,
  "slug": slug.current,
  summary,
  tags,
  vimeoId,
  client,
  featured,
  publishedAt,
  "posterUrl": poster.asset->url,
  "posterAlt": poster.alt,
  "category": category->{
    _id,
    title,
    "slug": slug.current
  }
}
GROQ;

        return $this->listResult($query, [
            'categorySlug' => $categorySlug,
            'limit' => $limit,
        ], $cacheSeconds);
    }

    public function testimonials(bool $featuredOnly = true, int $cacheSeconds = 600): array
    {
        $query = <<<'GROQ'
*[
  _type == "testimonial" &&
  (!$featuredOnly || featured == true)
]|order(displayOrder asc){
  _id,
  quote,
  name,
  role,
  company,
  featured,
  displayOrder,
  "avatarUrl": avatar.asset->url,
  "relatedService": relatedService->{
    _id,
    title,
    "slug": slug.current
  }
}
GROQ;

        return $this->listResult($query, ['featuredOnly' => $featuredOnly], $cacheSeconds);
    }

    public function homepageBundle(): array
    {
        return [
            'siteSettings' => $this->siteSettings(),
            'page' => $this->pageBySlug('home'),
            'services' => $this->services(),
            'portfolio' => $this->portfolioItems(limit: 6),
            'testimonials' => $this->testimonials(true),
        ];
    }

    public function contentHealth(): array
    {
        $countsQuery = <<<'GROQ'
{
  "siteSettings": count(*[_type == "siteSettings"]),
  "pages": count(*[_type == "page"]),
  "services": count(*[_type == "service"]),
  "portfolioCategories": count(*[_type == "portfolioCategory"]),
  "portfolioItems": count(*[_type == "portfolioItem"]),
  "testimonials": count(*[_type == "testimonial"])
}
GROQ;

        $issuesQuery = <<<'GROQ'
{
  "servicesMissingHero": *[_type == "service" && (!defined(hero) || !defined(hero.mediaType))]{_id, title},
  "portfolioMissingPoster": *[_type == "portfolioItem" && !defined(poster.asset)]{_id, title},
  "pagesMissingHero": *[_type == "page" && (!defined(hero) || !defined(hero.mediaType))]{_id, title}
}
GROQ;

        return [
            'counts' => $this->firstResult($countsQuery, [], 120) ?? [],
            'issues' => $this->firstResult($issuesQuery, [], 120) ?? [],
        ];
    }

    private function firstResult(string $query, array $params, int $cacheSeconds): ?array
    {
        $payload = $this->sanity->query($query, $params, $cacheSeconds);
        $result = $payload['result'] ?? null;

        return is_array($result) ? $result : null;
    }

    private function listResult(string $query, array $params, int $cacheSeconds): array
    {
        $payload = $this->sanity->query($query, $params, $cacheSeconds);
        $result = $payload['result'] ?? [];

        return is_array($result) ? $result : [];
    }
}
