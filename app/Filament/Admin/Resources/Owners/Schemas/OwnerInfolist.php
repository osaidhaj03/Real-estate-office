<?php

namespace App\Filament\Admin\Resources\Owners\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OwnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('الاسم الكامل'),
                TextEntry::make('phone')
                    ->label('رقم الهاتف الأساسي'),
                TextEntry::make('phone2')
                    ->label('رقم هاتف إضافي')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('البريد الإلكتروني')
                    ->placeholder('-'),
                TextEntry::make('id_number')
                    ->label('رقم الهوية / الإقامة')
                    ->placeholder('-'),
                TextEntry::make('nationality')
                    ->label('الجنسية')
                    ->placeholder('-'),
                TextEntry::make('owner_type')
                    ->label('نوع المالك')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'individual' => 'فرد',
                        'company' => 'شركة',
                    }),
                TextEntry::make('company_name')
                    ->label('اسم الشركة')
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->label('العنوان')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('notes')
                    ->label('ملاحظات إضافية')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('تاريخ التعديل')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
