export default (key, roomTypes = []) => {
    key = (key || '').trim().replaceAll('-', '_').replaceAll(' ', '_').replaceAll('р', 'p').replaceAll('о', 'o');
    const room = roomTypes.find(r => r.value === key);
    return room ? room.text : key.replaceAll('-', ' ').replaceAll('_', ' ');
}
