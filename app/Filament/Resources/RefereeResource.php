<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefereeResource\Pages;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\RefereeResource\RelationManagers;
use App\Models\confederation;
use App\Models\Referee;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

use function PHPSTORM_META\type;

class RefereeResource extends Resource
{
    protected static ?string $model = Referee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('confederation_id')
                    ->relationship('confederation', 'acronym')
                    ->preload()
                    ->searchable()    
                    ->label('confederation')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('image')
                    ->url()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birthdate')
                    ->required(),
                    select::make('nationality')
                    ->options(
                      
                     [
                         'Afghanistan' => 'Afghanistan',
                         'Albania' => 'Albania',
                         'Algeria' => 'Algeria',
                         'American Samoa' => 'American Samoa',
                         'Andorra' => 'Andorra',
                         'Angola' => 'Angola',
                         'Anguilla' => 'Anguilla',
                         'Antigua and Barbuda' => 'Antigua and Barbuda',
                         'Argentina' => 'Argentina',
                         'Armenia' => 'Armenia',
                         'Aruba' => 'Aruba',
                         'Australia' => 'Australia',
                         'Austria' => 'Austria',
                         'Azerbaijan' => 'Azerbaijan',
                         'Bahamas' => 'Bahamas',
                         'Bahrain' => 'Bahrain',
                         'Bangladesh' => 'Bangladesh',
                         'Barbados' => 'Barbados',
                         'Belarus' => 'Belarus',
                         'Belgium' => 'Belgium',
                         'Belize' => 'Belize',
                         'Benin' => 'Benin',
                         'Bermuda' => 'Bermuda',
                         'Bhutan' => 'Bhutan',
                         'Bolivia' => 'Bolivia',
                         'Bonaire' => 'Bonaire',
                         'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
                         'Botswana' => 'Botswana',
                         'Brazil' => 'Brazil',
                         'British Virgin Islands' => 'British Virgin Islands',
                         'Brunei' => 'Brunei',
                         'Bulgaria' => 'Bulgaria',
                         'Burkina Faso' => 'Burkina Faso',
                         'Burundi' => 'Burundi',
                         'Cambodia' => 'Cambodia',
                         'Cameroon' => 'Cameroon',
                         'Canada' => 'Canada',
                         'Cape Verde' => 'Cape Verde',
                         'Cayman Islands' => 'Cayman Islands',
                         'Central African Republic' => 'Central African Republic',
                         'Chad' => 'Chad',
                         'Chile' => 'Chile',
                         'China PR' => 'China PR',
                         'Chinese Taipei' => 'Chinese Taipei',
                         'Colombia' => 'Colombia',
                         'Comoros' => 'Comoros',
                         'Congo' => 'Congo',
                         'Cook Islands' => 'Cook Islands',
                         'Costa Rica' => 'Costa Rica',
                         'Côte d\'Ivoire' => 'Côte d\'Ivoire',
                         'Croatia' => 'Croatia',
                         'Cuba' => 'Cuba',
                         'Curaçao' => 'Curaçao',
                         'Cyprus' => 'Cyprus',
                         'Czech Republic' => 'Czech Republic',
                         'DR Congo' => 'DR Congo',
                         'Denmark' => 'Denmark',
                         'Djibouti' => 'Djibouti',
                         'Dominica' => 'Dominica',
                         'Dominican Republic' => 'Dominican Republic',
                         'Ecuador' => 'Ecuador',
                         'Egypt' => 'Egypt',
                         'El Salvador' => 'El Salvador',
                         'England' => 'England',
                         'Equatorial Guinea' => 'Equatorial Guinea',
                         'Eritrea' => 'Eritrea',
                         'Estonia' => 'Estonia',
                         'Eswatini' => 'Eswatini',
                         'Ethiopia' => 'Ethiopia',
                         'Faroe Islands' => 'Faroe Islands',
                         'Fiji' => 'Fiji',
                         'Finland' => 'Finland',
                         'France' => 'France',
                         'Gabon' => 'Gabon',
                         'Gambia' => 'Gambia',
                         'Georgia' => 'Georgia',
                         'Germany' => 'Germany',
                         'Ghana' => 'Ghana',
                         'Gibraltar' => 'Gibraltar',
                         'Greece' => 'Greece',
                         'Grenada' => 'Grenada',
                         'Guam' => 'Guam',
                         'Guatemala' => 'Guatemala',
                         'Guinea' => 'Guinea',
                         'Guinea-Bissau' => 'Guinea-Bissau',
                         'Guyana' => 'Guyana',
                         'Haiti' => 'Haiti',
                         'Honduras' => 'Honduras',
                         'Hong Kong' => 'Hong Kong',
                         'Hungary' => 'Hungary',
                         'Iceland' => 'Iceland',
                         'India' => 'India',
                         'Indonesia' => 'Indonesia',
                         'Iran' => 'Iran',
                         'Iraq' => 'Iraq',
                         'Ireland' => 'Ireland',
                         'Israel' => 'Israel',
                         'Italy' => 'Italy',
                         'Jamaica' => 'Jamaica',
                         'Japan' => 'Japan',
                         'Jordan' => 'Jordan',
                         'Kazakhstan' => 'Kazakhstan',
                         'Kenya' => 'Kenya',
                         'Kiribati' => 'Kiribati',
                         'Kosovo' => 'Kosovo',
                         'Kuwait' => 'Kuwait',
                         'Kyrgyzstan' => 'Kyrgyzstan',
                         'Laos' => 'Laos',
                         'Latvia' => 'Latvia',
                         'Lebanon' => 'Lebanon',
                         'Lesotho' => 'Lesotho',
                         'Liberia' => 'Liberia',
                         'Libya' => 'Libya',
                         'Liechtenstein' => 'Liechtenstein',
                         'Lithuania' => 'Lithuania',
                         'Luxembourg' => 'Luxembourg',
                         'Macao' => 'Macao',
                         'Madagascar' => 'Madagascar',
                         'Malawi' => 'Malawi',
                         'Malaysia' => 'Malaysia',
                         'Maldives' => 'Maldives',
                         'Mali' => 'Mali',
                         'Malta' => 'Malta',
                         'Marshall Islands' => 'Marshall Islands',
                         'Mauritania' => 'Mauritania',
                         'Mauritius' => 'Mauritius',
                         'Mexico' => 'Mexico',
                         'Micronesia' => 'Micronesia',
                         'Moldova' => 'Moldova',
                         'Monaco' => 'Monaco',
                         'Mongolia' => 'Mongolia',
                         'Montenegro' => 'Montenegro',
                         'Montserrat' => 'Montserrat',
                         'Morocco' => 'Morocco',
                         'Mozambique' => 'Mozambique',
                         'Myanmar' => 'Myanmar',
                         'Namibia' => 'Namibia',
                         'Nauru' => 'Nauru',
                         'Nepal' => 'Nepal',
                         'Netherlands' => 'Netherlands',
                         'New Caledonia' => 'New Caledonia',
                         'New Zealand' => 'New Zealand',
                         'Nicaragua' => 'Nicaragua',
                         'Niger' => 'Niger',
                         'Nigeria' => 'Nigeria',
                         'North Korea' => 'North Korea',
                         'North Macedonia' => 'North Macedonia',
                         'Northern Mariana Islands' => 'Northern Mariana Islands',
                         'Norway' => 'Norway',
                         'Oman' => 'Oman',
                         'Pakistan' => 'Pakistan',
                         'Palau' => 'Palau',
                         'Palestine' => 'Palestine',
                         'Panama' => 'Panama',
                         'Papua New Guinea' => 'Papua New Guinea',
                         'Paraguay' => 'Paraguay',
                         'Peru' => 'Peru',
                         'Philippines' => 'Philippines',
                         'Poland' => 'Poland',
                         'Portugal' => 'Portugal',
                         'Puerto Rico' => 'Puerto Rico',
                         'Qatar' => 'Qatar',
                         'Romania' => 'Romania',
                         'Russia' => 'Russia',
                         'Rwanda' => 'Rwanda',
                         'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
                         'Saint Lucia' => 'Saint Lucia',
                         'Saint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines',
                         'Samoa' => 'Samoa',
                         'San Marino' => 'San Marino',
                         'Sao Tome and Principe' => 'Sao Tome and Principe',
                         'Saudi Arabia' => 'Saudi Arabia',
                         'Senegal' => 'Senegal',
                         'Serbia' => 'Serbia',
                         'Seychelles' => 'Seychelles',
                         'Sierra Leone' => 'Sierra Leone',
                         'Singapore' => 'Singapore',
                         'Slovakia' => 'Slovakia',
                         'Slovenia' => 'Slovenia',
                         'Solomon Islands' => 'Solomon Islands',
                         'Somalia' => 'Somalia',
                         'South Africa' => 'South Africa',
                         'South Korea' => 'South Korea',
                         'South Sudan' => 'South Sudan',
                         'Spain' => 'Spain',
                         'Sri Lanka' => 'Sri Lanka',
                         'Sudan' => 'Sudan',
                         'Suriname' => 'Suriname',
                         'Sweden' => 'Sweden',
                         'Switzerland' => 'Switzerland',
                         'Syria' => 'Syria',
                         'Taiwan' => 'Taiwan',
                         'Tajikistan' => 'Tajikistan',
                         'Tanzania' => 'Tanzania',
                         'Thailand' => 'Thailand',
                         'Timor-Leste' => 'Timor-Leste',
                         'Togo' => 'Togo',
                         'Tonga' => 'Tonga',
                         'Trinidad and Tobago' => 'Trinidad and Tobago',
                         'Tunisia' => 'Tunisia',
                         'Turkey' => 'Turkey',
                         'Turkmenistan' => 'Turkmenistan',
                         'Turks and Caicos Islands' => 'Turks and Caicos Islands',
                         'Tuvalu' => 'Tuvalu',
                         'Uganda' =>  'Uganda',
                         'Ukraine' => 'Ukraine',
                         'United Arab Emirates' => 'United Arab Emirates',
                         'United States' => 'United States',
                         'Uruguay' => 'Uruguay',
                         'Uzbekistan' => 'Uzbekistan',
                         'Vanuatu' => 'Vanuatu',
                         'Vatican City' => 'Vatican City',
                         'Venezuela' => 'Venezuela',
                         'Vietnam' => 'Vietnam',
                         'Virgin Islands (British)' => 'Virgin Islands (British)',
                         'Virgin Islands (U.S.)' => 'Virgin Islands (U.S.)',
                         'Wales' => 'Wales',
                         'Wallis and Futuna' => 'Wallis and Futuna',
                         'Yemen' => 'Yemen',
                         'Zambia' => 'Zambia',
                         'Zimbabwe' => 'Zimbabwe'
                     ]                  
                       
                       
                       
     
                    )
                    ->searchable() 
                         ->required(),
               TextInput::make('experience')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(30)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->toggleable()->circular(),
                TextColumn::make('confederation.acronym')->label('confederation')->sortable()->searchable()->toggleable(),
                TextColumn::make('name')->sortable()->searchable()->toggleable(),
                TextColumn::make('birthdate')
                    ->dateTime()->toggleable(),
                TextColumn::make('nationality')->sortable()->searchable()->toggleable(),
                TextColumn::make('experience')->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()->toggleable(),
            ])->defaultSort('confederation_id')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReferees::route('/'),
            'create' => Pages\CreateReferee::route('/create'),
            'view' => Pages\ViewReferee::route('/{record}'),
            'edit' => Pages\EditReferee::route('/{record}/edit'),
        ];
    }    
}
