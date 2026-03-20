# Architecture: inky-extra

## Purpose
A Twig extension that integrates the Inky email templating language into Twig. Inky converts shorthand components (e.g., `<button>`, `<columns>`) into the verbose HTML table structures required by email clients.

## Directory Structure
```
InkyExtension.php       # Twig extension — registers the `inky_to_html` filter
Resources/
  functions.php         # Standalone helper functions (legacy / non-Twig usage)
Tests/
  IntegrationTest.php   # Integration tests for the Twig filter
  LegacyFunctionsTest.php
```

## Key Design Decisions
- **Thin wrapper** — this package does not implement Inky parsing itself; it delegates to the `twig/inky-extra` or `symfony/inky` library and exposes the result as a Twig filter.
- **Single-file extension** — all Twig integration is in `InkyExtension.php`, keeping the surface area minimal.
- **Legacy function bridge** — `Resources/functions.php` provides a procedural interface for projects not using Twig, maintaining backward compatibility.

## Extension Points
- The `inky_to_html` Twig filter is registered via `InkyExtension::getFilters()` and can be customised by subclassing.
- Replace the underlying Inky converter by injecting a different implementation into the extension constructor.

## Dependency Flow
```
Twig Environment
  └─ InkyExtension
       └─ inky_to_html filter
            └─ Inky converter (twig/inky-extra or symfony/inky)
                 └─ HTML table output suitable for email clients
```
