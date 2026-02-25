import {page} from './documents/page'
import {portfolioCategory} from './documents/portfolioCategory'
import {portfolioItem} from './documents/portfolioItem'
import {service} from './documents/service'
import {siteSettings} from './documents/siteSettings'
import {testimonial} from './documents/testimonial'
import {benefitItem} from './objects/benefitItem'
import {heroMedia} from './objects/heroMedia'
import {navItem} from './objects/navItem'
import {seo} from './objects/seo'

export const schemaTypes = [
  benefitItem,
  heroMedia,
  navItem,
  seo,
  siteSettings,
  page,
  service,
  portfolioCategory,
  portfolioItem,
  testimonial,
]
