<?php

namespace App\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsIconAlias;
use Filament\Widgets\AccountWidget;
use App\Filament\Widgets\WelcomeWidget;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;
use Illuminate\Contracts\Support\Htmlable;

class AdminHome extends Page
{
    protected string $view = 'filament.pages.admin-home';
/* The previous code is commented out to avoid conflicts with the Dashboard page
    //    protected static ?string $slug = '/'; // root of panel

//    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-home';
//    protected  string $view = 'filament.pages.admin-home';
//    protected static ?string $title = 'Inicio del panel';
//    protected static ?string $navigationLabel = 'Inicio';
*/
    protected static string $routePath = '/';

    protected static ?int $navigationSort = -2;

    public static function getNavigationLabel(): string
    {
        return __('Dashboard Admin');
    }
//
    public static function getNavigationIcon(): string | \BackedEnum | Htmlable | null
    {
        return static::$navigationIcon
            ?? FilamentIcon::resolve(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM)
            ?? (Filament::hasTopNavigation() ? Heroicon::Home : Heroicon::OutlinedHome);
    }
//
    public static function getRoutePath(Panel $panel): string
    {
        return static::$routePath;
    }
//
    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            WelcomeWidget::class
        ];
    }
   /* public function getWidgets(): array
    {
//        return AccountWidget::class;
        return [WelcomeWidget::class];
    }
*/
//    /**
//     * @deprecated Use `getWidgetsSchemaComponents($this->getWidgets())` to transform widgets into schema components instead, which also filters their visibility.
//     *
//     * @return array<class-string<Widget> | WidgetConfiguration>
//     */
//    public function getVisibleWidgets(): array
//    {
//        return $this->filterVisibleWidgets($this->getWidgets());
//    }
//
//    /**
//     * @return int | array<string, ?int>
//     */
//    public function getColumns(): int | array
//    {
//        return 2;
//    }
//
//    public function getTitle(): string | Htmlable
//    {
//        return static::$title ?? __('filament-panels::pages/dashboard.title');
//    }
//
//    public function content(Schema $schema): Schema
//    {
//        return $schema
//            ->components([
//                ...(method_exists($this, 'getFiltersForm') ? [$this->getFiltersFormContentComponent()] : []),
//                $this->getWidgetsContentComponent(),
//            ]);
//    }
//
//    public function getFiltersFormContentComponent(): Component
//    {
//        return EmbeddedSchema::make('filtersForm');
//    }
//
//    public function getWidgetsContentComponent(): Component
//    {
//        return Grid::make($this->getColumns())
//            ->schema($this->getWidgetsSchemaComponents($this->getWidgets()));
//    }

}


