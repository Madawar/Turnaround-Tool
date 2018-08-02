<?php
/**
 * Created by PhpStorm.
 * User: dwanyoike
 * Date: 5/31/2018
 * Time: 9:11 PM
 */

namespace App;

use Carbon\Carbon;
use PDF;
use Route;
use Illuminate\Support\Facades\File;
class Helper
{
    public function isCurrent($path)
    {


        $route = Route::current();


        if ($route->uri == $path) {
            return 'active';
        }
    }

    public function createReport($flight)
    {
        $name = str_slug($flight->cx->carrier . ' ' . $flight->flightNo . ' ' . $flight->flightDate);
        $exists = File::exists(storage_path("app/public/{$name}.pdf"));
        if (!$exists) {
            $pdf = PDF::setOptions(['dpi' => 150, 'defaultPaperSize' => 'a4'])
                ->loadView('report.flight_report', compact('flight'));
            $pdf->save(storage_path("app/public/{$name}.pdf"));
        }
        return $name . '.pdf';
    }

    public function FormatTime($time)
    {
        if (is_numeric($time)) {
            if (strlen($time) == 1) {
                return '0' . $time . ':' . '00';
            }
            if (strlen($time) == 2) {
                return $time . ':' . '00';
            }
            if (strlen($time) == 3) {
                return '0' . substr($time, 0, 1) . ':' . substr($time, 1, 2);
            }
            if (strlen($time) == 4) {
                $arr = str_split($time, strlen($time) / 2);
                return $arr[0] . ':' . $arr[1];
            }
        } else if (strpos($time, ':') !== false) {
            if (strlen($time) == 5) {
                return $time;
            }
            if (strlen($time) == 4) {
                $arr = explode(":", $time);
                if (strlen($arr[0]) == 1) {
                    $arr[0] = '0' . $arr[0];
                }
                return $arr[0] . ':' . $arr[1];
            }
        }
    }

    public function formatDate($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i');
        }
        return null;

    }

    public function parseDate($datetime, $currentFormat, $toFormat)
    {

        if ($datetime) {
            return Carbon::createFromFormat($currentFormat, $datetime)->format($toFormat);
        }
    }

    public function returnCarbon($datetime, $currentFormat, $toFormat)
    {

        if ($datetime) {
            return Carbon::createFromFormat($currentFormat, $datetime);
        }
        return null;
    }

    public function formatTimeForUser($date)
    {
        if ($date) {
            return Carbon::createFromFormat('H:i:s', $date)->format('H:i');
        }
        return $date;

    }

    public function fontawesome()
    {
        return array('address-book', 'address-card', 'adjust', 'alarm-clock', 'align-center', 'align-justify', 'align-left', 'align-right', 'allergies', 'ambulance', 'american-sign-language-interpreting', 'anchor', 'angle-double-down', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'archive', 'arrow-alt-circle-down', 'arrow-alt-circle-left', 'arrow-alt-circle-right', 'arrow-alt-circle-up', 'arrow-alt-down', 'arrow-alt-from-bottom', 'arrow-alt-from-left', 'arrow-alt-from-right', 'arrow-alt-from-top', 'arrow-alt-left', 'arrow-alt-right', 'arrow-alt-square-down', 'arrow-alt-square-left', 'arrow-alt-square-right', 'arrow-alt-square-up', 'arrow-alt-to-bottom', 'arrow-alt-to-left', 'arrow-alt-to-right', 'arrow-alt-to-top', 'arrow-alt-up', 'arrow-circle-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-down', 'arrow-from-bottom', 'arrow-from-left', 'arrow-from-right', 'arrow-from-top', 'arrow-left', 'arrow-right', 'arrows', 'arrows-alt', 'arrows-alt-h', 'arrows-alt-v', 'arrows-h', 'arrow-square-down', 'arrow-square-left', 'arrow-square-right', 'arrow-square-up', 'arrows-v', 'arrow-to-bottom', 'arrow-to-left', 'arrow-to-right', 'arrow-to-top', 'arrow-up', 'assistive-listening-systems', 'asterisk', 'at', 'audio-description', 'backward', 'badge', 'badge-check', 'balance-scale', 'ban', 'band-aid', 'barcode', 'barcode-alt', 'barcode-read', 'barcode-scan', 'bars', 'baseball', 'baseball-ball', 'basketball-ball', 'basketball-hoop', 'bath', 'battery-bolt', 'battery-empty', 'battery-full', 'battery-half', 'battery-quarter', 'battery-slash', 'battery-three-quarters', 'bed', 'beer', 'bell', 'bell-slash', 'bicycle', 'binoculars', 'birthday-cake', 'blanket', 'blind', 'bold', 'bolt', 'bomb', 'book', 'book-heart', 'bookmark', 'bowling-ball', 'bowling-pins', 'box', 'box-alt', 'box-check', 'boxes', 'boxes-alt', 'box-fragile', 'box-full', 'box-heart', 'boxing-glove', 'box-open', 'box-up', 'box-usd', 'braille', 'briefcase', 'briefcase-medical', 'browser', 'bug', 'building', 'bullhorn', 'bullseye', 'burn', 'bus', 'calculator', 'calendar', 'calendar-alt', 'calendar-check', 'calendar-edit', 'calendar-exclamation', 'calendar-minus', 'calendar-plus', 'calendar-times', 'camera', 'camera-alt', 'camera-retro', 'capsules', 'car', 'caret-circle-down', 'caret-circle-left', 'caret-circle-right', 'caret-circle-up', 'caret-down', 'caret-left', 'caret-right', 'caret-square-down', 'caret-square-left', 'caret-square-right', 'caret-square-up', 'caret-up', 'cart-arrow-down', 'cart-plus', 'certificate', 'chart-area', 'chart-bar', 'chart-line', 'chart-pie', 'check', 'check-circle', 'check-square', 'chess', 'chess-bishop', 'chess-bishop-alt', 'chess-board', 'chess-clock', 'chess-clock-alt', 'chess-king', 'chess-king-alt', 'chess-knight', 'chess-knight-alt', 'chess-pawn', 'chess-pawn-alt', 'chess-queen', 'chess-queen-alt', 'chess-rook', 'chess-rook-alt', 'chevron-circle-down', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-double-down', 'chevron-double-left', 'chevron-double-right', 'chevron-double-up', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-square-down', 'chevron-square-left', 'chevron-square-right', 'chevron-square-up', 'chevron-up', 'child', 'circle', 'circle-notch', 'clipboard', 'clipboard-check', 'clipboard-list', 'clock', 'clone', 'closed-captioning', 'cloud', 'cloud-download', 'cloud-download-alt', 'cloud-upload', 'cloud-upload-alt', 'club', 'code', 'code-branch', 'code-commit', 'code-merge', 'coffee', 'cog', 'cogs', 'columns', 'comment', 'comment-alt', 'comment-alt-check', 'comment-alt-dots', 'comment-alt-edit', 'comment-alt-exclamation', 'comment-alt-lines', 'comment-alt-minus', 'comment-alt-plus', 'comment-alt-slash', 'comment-alt-smile', 'comment-alt-times', 'comment-check', 'comment-dots', 'comment-edit', 'comment-exclamation', 'comment-lines', 'comment-minus', 'comment-plus', 'comments', 'comments-alt', 'comment-slash', 'comment-smile', 'comment-times', 'compass', 'compress', 'compress-alt', 'compress-wide', 'container-storage', 'conveyor-belt', 'conveyor-belt-alt', 'copy', 'copyright', 'couch', 'credit-card', 'credit-card-blank', 'credit-card-front', 'cricket', 'crop', 'crosshairs', 'cube', 'cubes', 'curling', 'cut', 'database', 'deaf', 'desktop', 'desktop-alt', 'diagnoses', 'diamond', 'dna', 'dollar-sign', 'dolly', 'dolly-empty', 'dolly-flatbed', 'dolly-flatbed-alt', 'dolly-flatbed-empty', 'donate', 'dot-circle', 'dove', 'download', 'dumbbell', 'edit', 'eject', 'ellipsis-h', 'ellipsis-h-alt', 'ellipsis-v', 'ellipsis-v-alt', 'envelope', 'envelope-open', 'envelope-square', 'eraser', 'euro-sign', 'exchange', 'exchange-alt', 'exclamation', 'exclamation-circle', 'exclamation-square', 'exclamation-triangle', 'expand', 'expand-alt', 'expand-arrows', 'expand-arrows-alt', 'expand-wide', 'external-link', 'external-link-alt', 'external-link-square', 'external-link-square-alt', 'eye', 'eye-dropper', 'eye-slash', 'fast-backward', 'fast-forward', 'fax', 'female', 'field-hockey', 'fighter-jet', 'file', 'file-alt', 'file-archive', 'file-audio', 'file-check', 'file-code', 'file-edit', 'file-excel', 'file-exclamation', 'file-image', 'file-medical', 'file-medical-alt', 'file-minus', 'file-pdf', 'file-plus', 'file-powerpoint', 'file-times', 'file-video', 'file-word', 'film', 'film-alt', 'filter', 'fire', 'fire-extinguisher', 'first-aid', 'flag', 'flag-checkered', 'flask', 'folder', 'folder-open', 'font', 'font-awesome-logo-full', 'football-ball', 'football-helmet', 'forklift', 'forward', 'fragile', 'frown', 'futbol', 'gamepad', 'gavel', 'gem', 'genderless', 'gift', 'glass-martini', 'globe', 'golf-ball', 'golf-club', 'graduation-cap', 'h1', 'h2', 'h3', 'hand-heart', 'hand-holding', 'hand-holding-box', 'hand-holding-heart', 'hand-holding-seedling', 'hand-holding-usd', 'hand-holding-water', 'hand-lizard', 'hand-paper', 'hand-peace', 'hand-point-down', 'hand-pointer', 'hand-point-left', 'hand-point-right', 'hand-point-up', 'hand-receiving', 'hand-rock', 'hands', 'hand-scissors', 'handshake', 'handshake-alt', 'hands-heart', 'hands-helping', 'hand-spock', 'hands-usd', 'hashtag', 'hdd', 'heading', 'headphones', 'heart', 'heartbeat', 'heart-circle', 'heart-square', 'hexagon', 'history', 'hockey-puck', 'hockey-sticks', 'home', 'home-heart', 'hospital', 'hospital-alt', 'hospital-symbol', 'hourglass', 'hourglass-end', 'hourglass-half', 'hourglass-start', 'h-square', 'i-cursor', 'id-badge', 'id-card', 'id-card-alt', 'image', 'images', 'inbox', 'inbox-in', 'inbox-out', 'indent', 'industry', 'industry-alt', 'info', 'info-circle', 'info-square', 'inventory', 'italic', 'jack-o-lantern', 'key', 'keyboard', 'lamp', 'language', 'laptop', 'leaf', 'leaf-heart', 'lemon', 'level-down', 'level-down-alt', 'level-up', 'level-up-alt', 'life-ring', 'lightbulb', 'link', 'lira-sign', 'list', 'list-alt', 'list-ol', 'list-ul', 'location-arrow', 'lock', 'lock-alt', 'lock-open', 'lock-open-alt', 'long-arrow-alt-down', 'long-arrow-alt-left', 'long-arrow-alt-right', 'long-arrow-alt-up', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'loveseat', 'low-vision', 'luchador', 'magic', 'magnet', 'male', 'map', 'map-marker', 'map-marker-alt', 'map-pin', 'map-signs', 'mars', 'mars-double', 'mars-stroke', 'mars-stroke-h', 'mars-stroke-v', 'medkit', 'meh', 'mercury', 'microchip', 'microphone', 'microphone-alt', 'microphone-slash', 'minus', 'minus-circle', 'minus-hexagon', 'minus-octagon', 'minus-square', 'mobile', 'mobile-alt', 'mobile-android', 'mobile-android-alt', 'money-bill', 'money-bill-alt', 'moon', 'motorcycle', 'mouse-pointer', 'music', 'neuter', 'newspaper', 'notes-medical', 'object-group', 'object-ungroup', 'octagon', 'outdent', 'paint-brush', 'pallet', 'pallet-alt', 'paperclip', 'paper-plane', 'parachute-box', 'paragraph', 'paste', 'pause', 'pause-circle', 'paw', 'pen', 'pen-alt', 'pencil', 'pencil-alt', 'pennant', 'pen-square', 'people-carry', 'percent', 'person-carry', 'person-dolly', 'person-dolly-empty', 'phone', 'phone-plus', 'phone-slash', 'phone-square', 'phone-volume', 'piggy-bank', 'pills', 'plane', 'plane-alt', 'play', 'play-circle', 'plug', 'plus', 'plus-circle', 'plus-hexagon', 'plus-octagon', 'plus-square', 'podcast', 'poo', 'portrait', 'pound-sign', 'power-off', 'prescription-bottle', 'prescription-bottle-alt', 'print', 'procedures', 'puzzle-piece', 'qrcode', 'question', 'question-circle', 'question-square', 'quidditch', 'quote-left', 'quote-right', 'racquet', 'ramp-loading', 'random', 'rectangle-landscape', 'rectangle-portrait', 'rectangle-wide', 'recycle', 'redo', 'redo-alt', 'registered', 'repeat', 'repeat-1', 'repeat-1-alt', 'repeat-alt', 'reply', 'reply-all', 'retweet', 'retweet-alt', 'ribbon', 'road', 'rocket', 'route', 'rss', 'rss-square', 'ruble-sign', 'rupee-sign', 'save', 'scanner', 'scanner-keyboard', 'scanner-touchscreen', 'scrubber', 'search', 'search-minus', 'search-plus', 'seedling', 'server', 'share', 'share-all', 'share-alt', 'share-alt-square', 'share-square', 'shekel-sign', 'shield', 'shield-alt', 'shield-check', 'ship', 'shipping-fast', 'shipping-timed', 'shopping-bag', 'shopping-basket', 'shopping-cart', 'shower', 'shuttlecock', 'sign', 'signal', 'sign-in', 'sign-in-alt', 'sign-language', 'sign-out', 'sign-out-alt', 'sitemap', 'sliders-h', 'sliders-h-square', 'sliders-v', 'sliders-v-square', 'smile', 'smile-plus', 'smoking', 'snowflake', 'sort', 'sort-alpha-down', 'sort-alpha-up', 'sort-amount-down', 'sort-amount-up', 'sort-down', 'sort-numeric-down', 'sort-numeric-up', 'sort-up', 'space-shuttle', 'spade', 'spinner', 'spinner-third', 'square', 'square-full', 'star', 'star-exclamation', 'star-half', 'step-backward', 'step-forward', 'stethoscope', 'sticky-note', 'stop', 'stop-circle', 'stopwatch', 'street-view', 'strikethrough', 'subscript', 'subway', 'suitcase', 'sun', 'superscript', 'sync', 'sync-alt', 'syringe', 'table', 'tablet', 'tablet-alt', 'tablet-android', 'tablet-android-alt', 'table-tennis', 'tablet-rugged', 'tablets', 'tachometer', 'tachometer-alt', 'tag', 'tags', 'tape', 'tasks', 'taxi', 'tennis-ball', 'terminal', 'text-height', 'text-width', 'th', 'thermometer', 'thermometer-empty', 'thermometer-full', 'thermometer-half', 'thermometer-quarter', 'thermometer-three-quarters', 'th-large', 'th-list', 'thumbs-down', 'thumbs-up', 'thumbtack', 'ticket', 'ticket-alt', 'times', 'times-circle', 'times-hexagon', 'times-octagon', 'times-square', 'tint', 'toggle-off', 'toggle-on', 'trademark', 'train', 'transgender', 'transgender-alt', 'trash', 'trash-alt', 'tree', 'tree-alt', 'triangle', 'trophy', 'trophy-alt', 'truck', 'truck-container', 'truck-couch', 'truck-loading', 'truck-moving', 'truck-ramp', 'tty', 'tv', 'tv-retro', 'umbrella', 'underline', 'undo', 'undo-alt', 'universal-access', 'university', 'unlink', 'unlock', 'unlock-alt', 'upload', 'usd-circle', 'usd-square', 'user', 'user-alt', 'user-alt-slash', 'user-astronaut', 'user-check', 'user-circle', 'user-clock', 'user-cog', 'user-edit', 'user-friends', 'user-graduate', 'user-lock', 'user-md', 'user-minus', 'user-ninja', 'user-plus', 'users', 'users-cog', 'user-secret', 'user-shield', 'user-slash', 'user-tag', 'user-tie', 'user-times', 'utensil-fork', 'utensil-knife', 'utensils', 'utensils-alt', 'utensil-spoon', 'venus', 'venus-double', 'venus-mars', 'vial', 'vials', 'video', 'video-plus', 'video-slash', 'volleyball-ball', 'volume-down', 'volume-mute', 'volume-off', 'volume-up', 'warehouse', 'warehouse-alt', 'watch', 'weight', 'wheelchair', 'whistle', 'wifi', 'window', 'window-alt', 'window-close', 'window-maximize', 'window-minimize', 'window-restore', 'wine-glass', 'won-sign', 'wrench', 'x-ray', 'yen-sign');
    }
}