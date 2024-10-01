This was imported from a 2007 website built with Joomla.
I've keept it for nostalgia.

However, it's now 2024. This used to be in PHP3 and the burden of maintaining this to modern PHP8 is too large, even for nostalgia. So I'm downloading everything as static, and serving it as-is. Bye PHP. This is now a fully static site.

If you wish to deploy this: first, ask yourself why, and then use herokuish/22; it's the latest image that'll run this as expected with PHP7.3.0. Starting with the 2024 image, PHP8 breaks too many things.
