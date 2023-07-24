import {Explorer} from '../../components';
import {Folder} from '../../types';
import {Create} from './create';
const folderData: Folder = {
    "id": "27d47eb2-0e65-4f4e-9ad1-9e590efc7f8d",
    "name": "Parent Folder",
    "parent_id": null,
    "children": [
        {
            "id": "75935b9e-3f1a-4ef3-8f71-43bcf6bfe157",
            "name": "Child Folder 1",
            "parent_id": "27d47eb2-0e65-4f4e-9ad1-9e590efc7f8d",
            "children": [
                {
                    "id": "efc3f732-4f46-4e57-96f7-3f0c4dd6c3f2",
                    "name": "Grandchild Folder 1",
                    "parent_id": "75935b9e-3f1a-4ef3-8f71-43bcf6bfe157",
                    "children": [],
                    "files": []
                },
                {
                    "id": "81e6d8ed-25ce-47d7-a4ed-3d8a30a6a2fd",
                    "name": "Grandchild Folder 2",
                    "parent_id": "75935b9e-3f1a-4ef3-8f71-43bcf6bfe157",
                    "children": [],
                    "files": []
                }
            ],
            "files": []
        },
        {
            "id": "4d165bfc-d8ae-4ad0-9d44-8fdd52a0c718",
            "name": "Child Folder 2",
            "parent_id": "27d47eb2-0e65-4f4e-9ad1-9e590efc7f8d",
            "children": [
                {
                    "id": "0e3e092a-f6dd-419f-85c2-5f4bb77c6ea0",
                    "name": "Grandchild Folder",
                    "parent_id": "4d165bfc-d8ae-4ad0-9d44-8fdd52a0c718",
                    "children": [
                        {
                            "id": "5c259b7f-c7df-4d68-9d57-14463838e8ce",
                            "name": "Great Grandchild Folder",
                            "parent_id": "0e3e092a-f6dd-419f-85c2-5f4bb77c6ea0",
                            "children": [],
                            "files": []
                        }
                    ],
                    "files": []
                }
            ],
            "files": []
        },
        {
            "id": "e8cc125d-99c9-4d0b-aeb9-9194d3d0f301",
            "name": "Child Folder 3",
            "parent_id": "27d47eb2-0e65-4f4e-9ad1-9e590efc7f8d",
            "children": [],
            "files": []
        }
    ],
    "files": [
        {
            "id": "e901d575-8299-4f4c-951a-f638d6f4c6a5",
            "name": "File 1",
            "sizeHuman": "10 KB",
            "url": "https://picsum.photos/200/300",
            "mime_type": "image/jpeg"
        },
        {
            "id": "548a42e6-2c97-4b0b-847b-4323e2c913e0",
            "name": "File 2",
            "sizeHuman": "15 KB",
            "url": "https://picsum.photos/300/400",
            "mime_type": "image/jpeg"
        },
        {
            "id": "ec4a4887-32a9-4b66-865d-93a4dd911eb3",
            "name": "File 3",
            "sizeHuman": "5 KB",
            "url": "https://picsum.photos/400/500",
            "mime_type": "image/jpeg"
        },
        {
            "id": "3f446b4d-0e1e-44ed-b163-8b7f949a8664",
            "name": "File 4",
            "sizeHuman": "20 KB",
            "url": "https://picsum.photos/500/600",
            "mime_type": "image/jpeg"
        },
        {
            "id": "6a231b45-9c7d-4f86-9a8e-829a39e1628f",
            "name": "File 5",
            "sizeHuman": "8 KB",
            "url": "https://picsum.photos/600/700",
            "mime_type": "image/jpeg"
        }
    ]
};

export const Index = () => {
    return (
        <div className="scrollList">
            <div className="scrollList">
                <Explorer {...folderData}/>
            </div>
        </div>
    )
}

export {Create};
