import fs from 'node:fs'
import path from 'node:path'

function readSanityEnv() {
  const envPath = path.resolve(process.cwd(), '..', '.env')
  const envText = fs.readFileSync(envPath, 'utf8')
  const lines = envText.split(/\r?\n/)
  const map = {}

  for (const line of lines) {
    const trimmed = line.trim()
    if (!trimmed || trimmed.startsWith('#') || !trimmed.includes('=')) continue

    const idx = trimmed.indexOf('=')
    const key = trimmed.slice(0, idx)
    const value = trimmed.slice(idx + 1)
    map[key] = value
  }

  return {
    projectId: map.SANITY_PROJECT_ID,
    dataset: map.SANITY_DATASET || 'production',
    apiVersion: map.SANITY_API_VERSION || '2024-01-01',
    token: map.SANITY_TOKEN,
  }
}

const docs = [
  {
    _id: 'siteSettings',
    _type: 'siteSettings',
    siteTitle: 'Future Digital Productions',
    tagline: 'Cinematic video for modern brands and events.',
    contactEmail: 'hello@futuredigitalproductions.com',
    contactPhone: '+1 (555) 010-2400',
    primaryNavigation: [
      {_key: 'home', label: 'Home', href: '/'},
      {_key: 'about', label: 'About', href: '/about'},
      {_key: 'services', label: 'Services', href: '/services'},
      {_key: 'portfolio', label: 'Portfolio', href: '/portfolio'},
      {_key: 'quote', label: 'Get a Quote', href: '/get-a-quote'},
      {_key: 'contact', label: 'Contact', href: '/contact'},
    ],
    defaultSeo: {
      metaTitle: 'Future Digital Productions',
      metaDescription:
        'Cinematic video production for weddings, music videos, corporate storytelling, and branded content.',
      noIndex: false,
    },
  },
  {
    _id: 'page-home',
    _type: 'page',
    title: 'Home',
    slug: {_type: 'slug', current: 'home'},
    headline: 'Cinematic stories that convert attention into emotion.',
    hero: {mediaType: 'video', vimeoId: '947729371', overlayOpacity: 0.45},
  },
  {
    _id: 'page-about',
    _type: 'page',
    title: 'About',
    slug: {_type: 'slug', current: 'about'},
    headline: 'A small crew with big-frame discipline.',
    hero: {mediaType: 'video', vimeoId: '947729371', overlayOpacity: 0.5},
  },
  {
    _id: 'page-contact',
    _type: 'page',
    title: 'Contact',
    slug: {_type: 'slug', current: 'contact'},
    headline: 'Tell us your vision. We will map the production.',
    hero: {mediaType: 'video', vimeoId: '947729371', overlayOpacity: 0.5},
  },
  {
    _id: 'page-get-a-quote',
    _type: 'page',
    title: 'Get a Quote',
    slug: {_type: 'slug', current: 'get-a-quote'},
    headline: 'Share scope, timeline, and outcomes.',
    hero: {mediaType: 'video', vimeoId: '947729371', overlayOpacity: 0.55},
  },
  {
    _id: 'portfolio-category-weddings',
    _type: 'portfolioCategory',
    title: 'Weddings',
    slug: {_type: 'slug', current: 'weddings'},
    description: 'Editorial wedding films focused on story and emotion.',
    displayOrder: 10,
  },
  {
    _id: 'portfolio-category-corporate',
    _type: 'portfolioCategory',
    title: 'Corporate',
    slug: {_type: 'slug', current: 'corporate'},
    description: 'Brand and corporate storytelling content.',
    displayOrder: 20,
  },
  {
    _id: 'service-weddings',
    _type: 'service',
    title: 'Weddings',
    slug: {_type: 'slug', current: 'weddings'},
    summary: 'Emotion-driven wedding films captured with cinematic polish.',
    headline: 'Your day, cut like cinema.',
    hero: {mediaType: 'video', vimeoId: '947729371', overlayOpacity: 0.45},
    description: [
      {
        _key: 'svcWedDesc1',
        _type: 'block',
        style: 'normal',
        markDefs: [],
        children: [{_key: 'svcWedDesc1c1', _type: 'span', text: 'Story-first edits and clean audio capture.', marks: []}],
      },
    ],
    keyBenefits: [
      {_key: 'wedB1', _type: 'benefitItem', title: 'Story-driven edits', description: 'Narrative over montage.'},
      {_key: 'wedB2', _type: 'benefitItem', title: 'Audio clarity', description: 'Vows and speeches captured cleanly.'},
    ],
    displayOrder: 10,
  },
  {
    _id: 'service-corporate',
    _type: 'service',
    title: 'Corporate',
    slug: {_type: 'slug', current: 'corporate'},
    summary: 'Brand films and campaign assets designed for business outcomes.',
    headline: 'Business video that moves buyers forward.',
    hero: {mediaType: 'video', vimeoId: '947729371', overlayOpacity: 0.45},
    description: [
      {
        _key: 'svcCorpDesc1',
        _type: 'block',
        style: 'normal',
        markDefs: [],
        children: [{_key: 'svcCorpDesc1c1', _type: 'span', text: 'Concept to delivery for conversion-focused messaging.', marks: []}],
      },
    ],
    keyBenefits: [
      {_key: 'corpB1', _type: 'benefitItem', title: 'Campaign-ready outputs', description: 'Multi-format exports for web and social.'},
      {_key: 'corpB2', _type: 'benefitItem', title: 'Message clarity', description: 'Script and edit structure tuned for conversion.'},
    ],
    displayOrder: 20,
  },
  {
    _id: 'testimonial-1',
    _type: 'testimonial',
    quote: 'The team captured every emotional beat and delivered a film we will watch for life.',
    name: 'Ava Thompson',
    role: 'Bride',
    featured: true,
    displayOrder: 10,
    relatedService: {_type: 'reference', _ref: 'service-weddings'},
  },
  {
    _id: 'testimonial-2',
    _type: 'testimonial',
    quote: 'Our campaign video outperformed previous launches and gave sales a stronger story.',
    name: 'Marcus Lee',
    role: 'Marketing Director',
    company: 'Northline Labs',
    featured: true,
    displayOrder: 20,
    relatedService: {_type: 'reference', _ref: 'service-corporate'},
  },
]

async function run() {
  const env = readSanityEnv()
  if (!env.projectId || !env.dataset || !env.apiVersion || !env.token) {
    throw new Error('Missing Sanity credentials in ../.env')
  }

  const mutateUrl = `https://${env.projectId}.api.sanity.io/v${env.apiVersion}/data/mutate/${env.dataset}`
  const queryUrl = `https://${env.projectId}.api.sanity.io/v${env.apiVersion}/data/query/${env.dataset}`

  const mutations = docs.map((doc) => ({createOrReplace: doc}))
  const mutateRes = await fetch(mutateUrl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Authorization: `Bearer ${env.token}`,
    },
    body: JSON.stringify({mutations}),
  })

  if (!mutateRes.ok) {
    const body = await mutateRes.text()
    throw new Error(`Seed mutation failed (${mutateRes.status}): ${body}`)
  }

  const verifyQuery = '*[_type in ["siteSettings","page","service","portfolioItem","testimonial"]]{_id,_type}'
  const verifyRes = await fetch(`${queryUrl}?query=${encodeURIComponent(verifyQuery)}`, {
    headers: {Authorization: `Bearer ${env.token}`},
  })

  if (!verifyRes.ok) {
    const body = await verifyRes.text()
    throw new Error(`Seed verification failed (${verifyRes.status}): ${body}`)
  }

  const data = await verifyRes.json()
  console.log(`Seed complete. Upserted ${docs.length} docs. Key-doc count: ${data.result.length}.`)
}

run().catch((err) => {
  console.error(err)
  process.exit(1)
})
