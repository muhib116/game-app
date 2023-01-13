export default function useDataSource(){
    let taskData = [
        {
            title: 'Task#1: Find the tower',
            description: 'You and your team should find the eiffel tower and take a creative photo of the group infront of the effiel tower. Once you have uploaded the image, next task will be served.'
        }
    ]
    return {
        taskData
    }
}