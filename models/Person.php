<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "person".
 *
 * @property int $id ID
 * @property string $name Имя
 * @property string $surname Фамилия
 * @property string $patronymic Отчество
 * @property string $name_scanner Имя в сканере
 * @property int $sex_id Пол
 * @property string $birthdate Дата рождения
 * @property string $birth_place Место рождения
 * @property string $location92 В 92 году проживал
 * @property string $scanner_task
 * @property int $family_id Семья
 * @property int $children_id Дети
 * @property int $education_id
 * @property int $branch_id
 * @property int $pension_id
 * @property int $is_religious
 * @property int $workarea_id
 * @property int $qualification_id
 * @property string $came_from
 * @property int $how_long_id
 * @property int $cause_id
 * @property array $worry_ids
 * @property int $relation_id
 * @property int $prefer_id Предпочитаете
 * @property int $try_id Какие мерыпредпренимали для определения на жительство
 * @property int $hobby_id Хобби
 * @property int $is_work_search Искали работу?
 * @property int $work_search_id Поиск работы
 * @property int $agency_id Находились ли раньше?
 * @property int $agency_leave_id Почему покинули?
 * @property array $plan_ids Планы на будущее
 * @property array $socialhelp1_ids Соц услуги 1
 * @property array $socialhelp2_ids Соц услуги 2
 */
class Person extends MyActiveRecord
{

    public $upload, $del_upload;

    public $status = [
        0 => 'Первичное обращение',
        1 => 'Без мед. обследования',
        2 => 'Зачислен',
        3 => 'Отчислен',
        4 => 'Переведен в КСЦ РО',
        5 => 'Госпитализирован',
        6 => 'Выписан',
    ];
    public $family = [
        0 => 'Не был женат (замужем)',
        1 => 'В браке',
        2 => 'В разводе',
    ];
    public $children = [
        0 => 'Детей нет',
        1 => '1 ребенок',
        2 => '2 детей',
        3 => '3 и более детей',
    ];

    public $education = [
        0 => 'Начальное',
        1 => 'Среднее общее',
        2 => 'Среднее полное',
        3 => 'Начальное профессиональное',
        4 => 'Среднее профессиональное',
        5 => 'Неоконченное высшее',
        6 => 'Высшее профессиональное',
    ];

    public $pension = [
        0 => 'Нет',
        1 => 'Пенсионер по старости',
        2 => 'Инвалид I группы',
        3 => 'Инвалид II группы',
        4 => 'Инвалид III группы',
    ];

    public $workarea = [
        0 => 'Нигде не работал',
        1 => 'Промышленность',
        2 => 'Строительство',
        3 => 'Торговля, сфера обслуживания',
        4 => 'Коммерция',
        5 => 'Промышленность',
        6 => 'Строительство',
        7 => 'Торговля, сфера обслуживания',
        8 => 'Армия',
        9 => 'Сельское хозяйство',
        10 => 'Транспорт',
        11 => 'Связь',
        12 => 'Наука, образование',
    ];

    public $qualification = [
        0 => 'Нигде не работал',
        1 => 'Разнорабочий',
        2 => 'Квалифицированный рабочий',
        3 => 'Сельское хозяйство',
        4 => 'Военнослужащий',
        5 => 'Специалист (гуманитарный)',
        6 => 'Специалист (инженерно-технический)',
        7 => 'Коммерция / Экономика',
        8 => 'Другое',
    ];

    public $how_long = [
        0 => 'До 1 года',
        1 => 'От 1 года до 3 лет',
        2 => 'От 3 лет до 5 лет',
        3 => 'Свыше 5 лет',
    ];


    public $cause = [
        0 => 'Конфликт в семье, с родственниками',
        1 => 'Отсутствие постоянного места работы',
        2 => 'Возврашение из мест заключения',
        3 => 'Утрата средств к сушествованию',
        4 => 'Кредитная зависимость',
        5 => 'Долговая зависимость',
        6 => 'Смерть близких родственников',
        7 => 'Стремление к вольной жизни',
        8 => 'Воспитанник детского дома',
        9 => 'Отсутствие документов',
        10 => 'Квартирные махинации',
        11 => 'Болезнь',
        12 => 'Другое',
    ];

    public $relation = [
        0 => 'Не указано',
        1 => 'Нас связывают взаимопонимание и взаимопомощь',
        2 => 'Стараемся не вступать в конфликт  друг с другом',
        3 => 'Не замечаем друг друга, не общаемся  между собой',
        4 => 'Наши отношения можно назвать конфликтными',
        5 => 'Другое'
    ];

    public $prefer = [
        0 => 'Не указано',
        1 => 'Быть одному',
        2 => 'Собираться по 2 - 3 человека',
        3 => 'Собираться большой группой',
    ];

    public $try = [
        0 => 'Никуда не обращался',
        1 => 'Обращался в органы милиции',
        2 => 'Обращался в органы социальной зашиты',
        3 => 'Хотел вернуться на прежнее место жительства',
        4 => 'Обращался к своим родственникам и знакомым',
        5 => 'Другое',

    ];

    public $work_search = [
        0 => 'Нет ответа',
        1 => 'Обращался на биржу труда',
        2 => 'Обращался в органы социальной защиты',
        3 => 'Обращался по прежнему месту работы',
        4 => 'Самостоятельно',
    ];

    public $agency = [
        0 => 'Нет ответа',
        1 => 'Пребывал в ночлежном доме (ночлежке)',
        2 => 'Жил в специальном интернате',
        3 => 'В приемнике - распределителе',
        4 => 'Отбывал срок заключения',
        5 => 'Другое',
    ];

    public $agency_leave = [
        0 => 'Нет ответа',
        1 => 'Окончился срок пребывания',
        2 => 'Плохое отношение персонала',
        3 => 'Хотел встретиться с друзьями',
        4 => 'Плохое отношение с проживающими',
        5 => 'Выписали за нарушения',
        6 => 'Хотелось свободы',
        7 => 'Стало скучно',
        8 => 'Другое',
    ];

// checkbox multiselect
    public $hobbys = [
        0 => 'Чтение, Литература',
        1 => 'Спорт',
        2 => 'Проводить время на природе',
        3 => 'Рукоделие',
        4 => 'Ремесленничество',
        5 => 'Художественная самодеятельность',
    ];

    public $plans = [
        0 => 'Обращусь на биржу труда',
        1 => 'Обращусь за помощью в органы полиции',
        2 => 'Обращусь в органы социальной защиты',
        3 => 'Вернусь домой, в семью',
        4 => 'Постараюсь устроится в дом-интернат',
        5 => 'Постараюсь найти работу',
        6 => 'Постараюсь найти жилье',
        7 => 'Ничего не буду делать, мне привычно так жить',
    ];

    public $socialhelp1s = [
        0 => 'Мат помощь в виде продуктов питания',
        1 => 'Мат помощь в виде одежды',
        2 => 'Предоставление места в доме-интернате',
        3 => 'Содействие социальной и трудовой реабилитации',
        4 => 'Предоставление временного ночлега',
    ];

    public $socialhelp2s = [
        0 => 'Медицинская помощь',
        1 => 'Психологическая и психотерапевтическая помощь',
        2 => 'Юридическая помощь',
        3 => 'Социально-консультативная помощь',
        4 => 'Консультации геронтолога (специалист по работе с пожилыми людьми)',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     * @return PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonQuery(get_called_class());
    }

    public function showProfileTable()
    {
     if($this->family_id)  $line1 = '<td>Семейное положение</td><td>'.mb_strtolower($this->family[$this->family_id]).'</td>';
        if($this->children_id)    $line111 = '<td>Дети</td><td>'.mb_strtolower($this->children[$this->children_id]).'</td>';
        if($this->pension_id)    $line11 = '<td>Пенсионер</td><td>' . mb_strtolower($this->pension[$this->pension_id]);
        if($this->education_id)    $line2 = '<td>Образование</td><td>' . mb_strtolower($this->education[$this->education_id] . '; ' . $this->qualification[$this->qualification_id]) . '; ';
        if($this->qualification_id)    $line21 = '<td>Специальность</td><td>' . $this->qualification[$this->qualification_id] . '; ';
        if($this->workarea_id)    $line3 = '<td>Работа</td><td>' . mb_strtolower($this->workarea[$this->workarea_id] . ($this->work_search_id ? ', ' . $this->work_search[$this->work_search_id] : ''));
        if($this->how_long_id)     $line4 = '<td>Бездомная жизнь, причины</td><td>' . mb_strtolower($this->how_long[$this->how_long_id] . '; ' . $this->cause[$this->cause_id]);
        if($this->relation_id)   $line5 ='<td>Отношения с другими бездомными<td>' . mb_strtolower($this->relation[$this->relation_id] . "</td>");
        if($this->try_id)  $line6 = '<td>Что делали для определения на жительство</td><td>' . mb_strtolower($this->try[$this->try_id]);
        if($this->prefer_id)  $line7 = '<td>Вы предпочитаете</td><td>' . mb_strtolower($this->prefer[$this->prefer_id]) . "</td>";
        if($this->agency_id) {
            $line8 = '<td>Находились ли в спецучреждениях; почему покинули?</td><td> ' .
                mb_strtolower($this->agency[$this->agency_id] . '; '
                    . $this->agency_leave_id ?? $this->agency_leave[$this->agency_leave_id]) . "</td>";
        }
        if($this->hobby_ids) $hobby = $this->hobby_ids ? '<td>Хобби</td><td>' . mb_strtolower(implode(', ', array_intersect_key($this->hobbys, array_flip($this->hobby_ids)))) . "</td>" : '';
        if($this->plan_ids) $plans = $this->plan_ids ? '<td>Планы</td><td>' . mb_strtolower(implode(', ', array_intersect_key($this->plans, array_flip($this->plan_ids)))) . "</td>" : '';


        $help1 = $this->socialhelp1_ids ? implode(', ', array_intersect_key($this->socialhelp1s, array_flip($this->socialhelp1_ids))) : '';
        $help2 = $this->socialhelp2_ids ? implode(', ', array_intersect_key($this->socialhelp2s, array_flip($this->socialhelp2_ids))) : '';
        $help = ($this->socialhelp1_ids OR $this->socialhelp2_ids) ? '<td>Необходима помощь</td><td>' . mb_strtolower($help1 . '; ' . $help2) : '';

         @$return = "<table id='my_profile_table1' class='ui very compact selectable celled small table'>
  <!--thead>
    <tr><th style='width: 30%;'><i class='grey question circle outline
 icon'></i>Вопрос</th>
    <th><i class='grey comment outline icon'></i>Ответ</th>
  </tr></thead-->
 <tr>$line1</tr>
 <tr>$line111</tr>
<tr>$line11</tr>
<tr>$line2</tr>
<tr>$line3</tr>
<tr>$line4</tr>
<tr>$line5</tr>
<tr>$line6</tr>
<tr>$line7</tr>
<tr>$line8</tr>
<tr>$hobby</tr>
<tr>$plans</tr>
<tr>$help</tr> 
</table>";

        return $return;
    }

    public function showProfile()
    {
        $line1 = $this->family[$this->family_id] . '; ' .
            $this->children[$this->children_id] . '; ' .
            ($this->pension_id ? $this->pension[$this->pension_id] . '; ' : '');
        $line2 = '<i>Образование:</i> ' . mb_strtolower($this->education[$this->education_id] . '; ' . $this->qualification[$this->qualification_id]) . '; ';
        $line3 = '<i>Работа:</i> ' . mb_strtolower($this->workarea[$this->workarea_id] . ($this->work_search_id ? ', ' . $this->work_search[$this->work_search_id] : ''));
        $line4 = '<i>Бездомная жизнь:</i> ' . mb_strtolower($this->how_long[$this->how_long_id] . ', ' . $this->cause[$this->cause_id]);
        $line5 = $this->relation_id ? 'Отношения с другими:</i> ' . $this->relation[$this->relation_id] . "<br>\n" : '';
        $line6 = '<i>Что делали для определения на жительство:</i> ' . mb_strtolower($this->try[$this->try_id]);
        $line7 = $this->prefer_id ? '<i>Вы предпочитаете:</i> ' . mb_strtolower($this->prefer[$this->prefer_id]) . "<br>\n" : '';
        $line8 = $this->agency_id ? '<i>Находились ли в спецучреждениях:</i> ' .
            mb_strtolower($this->agency[$this->agency_id] . '; ' . $this->agency_leave[$this->agency_leave_id]) . "<br>\n" : '';

        $hobby = $this->hobby_ids ? '<i>Хобби:</i> ' . mb_strtolower(implode(', ', array_intersect_key($this->hobbys, array_flip($this->hobby_ids)))) . "<br>\n" : '';
        $plans = $this->plan_ids ? '<i>Планы:</i> ' . mb_strtolower(implode(', ', array_intersect_key($this->plans, array_flip($this->plan_ids)))) . "<br>\n" : '';


        $help1 = $this->socialhelp1_ids ? implode(', ', array_intersect_key($this->socialhelp1s, array_flip($this->socialhelp1_ids))) : '';
        $help2 = $this->socialhelp2_ids ? implode(', ', array_intersect_key($this->socialhelp2s, array_flip($this->socialhelp2_ids))) : '';
        $help = ($this->socialhelp1_ids OR $this->socialhelp2_ids) ? '<i>Необходима помощь:</i> ' . mb_strtolower($help1 . '; ' . $help2) : '';

        return "$line1<br><br>\n$line2<br>\n$line3<br><br>\n$line4<br>\n$line5
        $line6<br>\n$line7$line8$hobby$plans<br>\n$help";
    }
//public function showBio(){
//
//}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','status_id'], 'required'],
            [['del_upload', 'sex_id', 'branch_id', 'status_id', 'family_id', 'children_id', 'education_id', 'pension_id', 'is_religious', 'workarea_id', 'qualification_id', 'how_long_id', 'cause_id', 'relation_id', 'prefer_id', 'try_id', 'is_work_search', 'work_search_id', 'agency_id', 'agency_leave_id'], 'integer'],
            [['bio_rows','reg_rows','birthdate', 'hobby_ids', 'worry_ids', 'plan_ids', 'name_scanner', 'birth_place', 'location92', 'scanner_task', 'came_from', 'socialhelp1_ids', 'socialhelp2_ids'], 'safe'],
            [['name','patronymic',  'surname', 'photo'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_id' => 'Статус',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'photo' => 'Фотография',
            'upload' => 'Фотография',
            'del_upload' => 'Удалить фото',
            'name_scanner' => 'Имя в сканере',
            'branch_id' => 'Подразделение',
            'sex' => '',
            'birthdate' => 'Дата рождения',
            'birth_place' => 'Место рождения',
            'location92' => 'В 92 году проживал',
            'scanner_task' => 'Scanner Task',
            'family_id' => 'Семейное положение',
            'children_id' => 'Дети',
            'education_id' => 'Образование',
            'pension_id' => 'Пенсионер',
            'is_religious' => 'Считаете ли вы себя верующим человеком?',
            'workarea_id' => 'В какой области работали',
            'qualification_id' => 'Специальность',
            'came_from' => 'Из какого населенного пункта вы приехали',
            'how_long_id' => 'Как давно вы ведете бездомный образ жизни',
            'cause_id' => 'Что явилось причиной бездомной жизни',
            'worry_ids' => 'Что вас больше всего беспокоит в настоящее время?',
            'relation_id' => 'Ваши отношения с другими бездомными',
            'prefer_id' => 'Проживая без крыши над головой, вы предпочитаете',
            'try_id' => 'Что делали для определения на жительство',
            'hobby_ids' => 'Ваши увлечения, хобби',
            'is_work_search' => 'Что делали, чтобы найти работу',
            'work_search_id' => 'Что делали, чтобы найти работу',
            'agency_id' => 'Находились ли раньше в спец учереждениях',
            'agency_leave_id' => 'Если находились, почему покинули',
            'plan_ids' => 'Ваши планы на будущее',
            'socialhelp1_ids' => 'Какой вид соцуслуг жизненно необходим 1',
            'socialhelp2_ids' => 'Какой вид соцуслуг жизненно необходим 2',
        ];
    }
public function age(){

        $age = 0;
     if ($this->birthdate){
         $date = new \DateTime($this->birthdate);
         $now = new \DateTime();
         $interval = $now->diff($date);
         $age =  $interval->y;
     }  elseif (is_array($this->bio_rows)){
         $date_str = json_decode($this->bio_rows)[0]->date1;
         $date = new \DateTime($date_str);
         $now = new \DateTime();
         $interval = $now->diff($date);
         $age =  $interval->y;
     }
   return $age;
}
    public function photo()
    {
        return $this->photo ?? '_avatar.png';
    }

    public function getDocs()
    {
        return $this->hasMany(Doc::className(), ['person_id' => 'id']);
    }
    public function getBranch(){
        return $this->hasOne(Branch::className(),['id' => 'branch_id']);
    }

    public static function translit($str){
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
        return str_replace($rus, $lat, $str);
    }

    public function translitName($name_scanner = ''){
        if ($name_scanner=='') {
            $name_scanner = $this->surname .'_'.$this->name.'_'.$this->patronymic;
            $translited = $this->translit($name_scanner);

          // проверка если такой логин есть, то прибавляем в конце единицу
            $if_exists = Person::find()->where(['name_scanner'=> $translited])->all();
    if ($if_exists) $translited.='1';
        }
        return $translited;
}


}
